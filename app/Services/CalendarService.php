<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\ExperimentalClass;
use App\Models\Registration;
use App\Models\RegistrationClass;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;

class CalendarService {


    public function listScheduledClass($start, $end, $params=[]) {
        $status =  [
            'PP' => 'olive',
            'FF' => 'custom-danger',
            'FJ' => 'custom-warning',
            'CC' => 'custom-secondary',
            ''   => 'custom-primary',
            'AE' => 'custom-info' 
        ];

      
        $calendar = [];

        $classes = Classes::with('student.user')
                        ->with('student.installmentsToPay')
                        ->with('student.repositions')
                        ->with('registration.modality')
                        ->with('modality')
                        ->whereBetween('date', [$start, $end])
                        ->orderBy('type', 'asc');

        if($params) {
            foreach($params as $field => $value) {
                $classes->where($field, $value);
            }
        }
        

        $classes = $classes->get();

        foreach($classes as $event) {

            $bg = 'bg-'.$status[$event->situation];

            if($event->type == 'AE' && $event->status == 0) {
                $bg = ' bg-custom-purple';
            }

         
            $icon = '';
            $typeLabel = ($event->type !== 'AN') ? '('.$event->type.')' : '';;

            if($event->type != 'AE' ) {

                $studentName = $event->student->user->shortName;

                if(!empty($this->listPendencies($event))) {
                    $icon = '<span><i class="fa fa-exclamation-circle mx-1 text-warning" aria-hidden="true"></i></span>';
                }

 
                
            } else {
                $studentName = $event->name;
            }

            
            
            $calendar[] = [
                'id'         => $event->id,
                'event_type' => 'class',
                'type'       => $event->situation,
                'title'      => $icon . '<strong>'.date('H\h\\', strtotime($event->time)) . ' '. $typeLabel . '</strong> '.  $studentName,
                'start'      => $event->date->format('Y-m-d') . 'T' . $event->time,
                'end'        => $event->date->format('Y-m-d') . 'T' . date('H:i:s', strtotime($event->time . '+1 hours')),
                'className'  => [$bg, 'border-0'],
            ];

        }

        $registrations = Registration::with('student.user')->with('modality')->with('weekdays')->where('is_active', 1)->get();

        foreach($registrations as $reg) {
            foreach($reg->weekdays as $event) {
                $calendar[] = [
                    'id' => $reg->id,
                    'event_type' => 'recurrent',
                    'title' => '<strong>'.date('H\h\\', strtotime($event->time)) . '</strong> '. $reg->student->user->shortName . ' <sstrong>('.$reg->modality->nick.')</sstrong>',
                    'startTime' => $event->time,
                    'endTime' => date('H:i:s', strtotime($event->time . ' + 1 hour')),
                    'daysOfWeek' => [$event->weekday],
                    'startRecur' => $reg->end,
                    'className' => ['bg-custom-primary opacity-25', 'border-0'],
                ];
            }
        }

        return $calendar;

    }

    public function listPendencies($event) {


        $pendencies = [];

        if($event->type == 'AE') {
            return [];
        }

        if($event->student->installmentsToPay->count() > 0) {
            $pendencies[] = ['status' => 'danger', 'message' => 'Pagamentos a realizar!'];
        }

        if($event->student->repositions()->count()) { 
            $pendencies[] = ['status' => 'warning', 'message' => 'Reposições não agendadas!'];
        }

        if($event->registration->daysToRenew <= 3) { 
            $pendencies[] = ['status' => 'info', 'message' => 'Matrícula em '.$event->registration->modality->name . ' ' .  $event->registration->position];
        }

        return $pendencies;
    }

    public function listStudentsClassNotRemarked() {
        return Student::with('user')->with('classes')->whereHas('classes', function($q) {
            $q->where('situation', '<>', 'PP')->where('status', 1)->where('has_reposition', 0);
        })->get()->sortBy('user.name')->pluck('user.name', 'id');
    }

    public function listClassesToRemarkByStudent($id){
        $except = Classes::where('student_id', $id)->whereNotNull('class_reposition_id')->where('status', 1)->get()->pluck('class_reposition_id');
 
        // $data = Classes::with('modality')->where('student_id', $id)
        //         ->where('situation', '<>', 'PP')
        //         ->whereNull('class_reposition_id')
        //         ->whereNotIn('id', $except)
        //         ->orderBy('date', 'asc')
        //         ->get();


        $data = Classes::with('modality')
                ->where('student_id', $id)
                // ->whereNotIn('situation', '<>', 'PP')
                ->whereNotIn('id', $except)
                ->orderBy('date', 'asc')
                ->get();

        return $data;

    }

    public function listEventsByDate($date) {
        $classes = Classes::with('student.user')
                        ->with('student.installmentsToPay')
                        ->with('student.repositions')
                        ->with('registration.modality')
                        ->with('instructor')
                        ->with('student.evolutions')
                        ->with('modality')
                        ->with('parent')
                        ->whereDate('date', $date)
                        ->orderBy('time', 'asc')->get();

        $response = [];
        
        $response['day'] = dateExt($date);
        foreach($classes as $class) {

            $class->pendencies = $this->listPendencies($class);

            $response['data'][$class->time][] = $class;
        }

        return $response;

    }

}