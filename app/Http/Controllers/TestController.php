<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index() {

        $prod = 'prod';
        $local = 'mysql';
         
        $usersProd        = DB::connection($prod)->select('SELECT * FROM users');
        $instructorsProd  = DB::connection($prod)->select('SELECT * FROM instructors');
        $studentsProd     = DB::connection($prod)->select('SELECT * FROM students');
        $registrationProd = DB::connection($prod)->select('SELECT * FROM registrations');
        $classesProd      = DB::connection($prod)->select('SELECT * FROM classes');
        $paymentsProd     = DB::connection($prod)->select('SELECT * FROM payment_methods');
        $transactionsProd = DB::connection($prod)->select('SELECT * FROM transactions');

    
        Artisan::call('migrate:fresh --seed');
        
        DB::unprepared('SET FOREIGN_KEY_CHECKS=0');

        // Usuarios
        foreach($usersProd as $user) {
            $user = (array) $user;

            $user['image'] = $user['avatar'];
            unset($user['avatar']);

            DB::connection($local)->table('users')->insert($user);
        }

        // Alunos
        foreach($studentsProd as $item) {
            $item = (array) $item;
            $item['tenant_id'] = 2;

            unset($item['deleted_at']);
            unset($item['enabled']);
            DB::connection($local)->table('students')->insert($item);
        }

        // Professores
        foreach($instructorsProd as $item) {
            $item = (array) $item;
            $item['tenant_id'] = 2;

            $item['occupation'] = $item['profession'];
            $item['document'] = $item['profession_register'];

            unset($item['deleted_at']);
            unset($item['profession']);
            unset($item['profession_register']);
            unset($item['enabled']);
            DB::connection($local)->table('instructors')->insert($item);
        }


        // Matriculas
        foreach($registrationProd as $item) {
            $item = (array) $item;
            $item['tenant_id'] = 2;

            
            

            unset($item['class_value']);

            $item['is_active'] = $item['status'];
            unset($item['status']);

            $cls = json_decode($item['weekclasses']);
            $item['class_week'] = $item['weekclasses'];
            unset($item['weekclasses']);

            $item['modality_id'] = $item['modality_id'] + 2;
           
            unset($item['cancel_date']);
            unset($item['cancel_comments']);
            unset($item['description']);
  
            DB::connection($local)->table('registrations')->insert($item);

            
            foreach($cls as $c) {
                $c = (array) $c;
                $c['registration_id'] = $item['id'];
                $c['tenant_id'] = $item['tenant_id'];
                DB::connection($local)->table('registration_classes')->insert($c);
            }
        }

        // Aulas
        $situation = [
            1 => 'PP',
            2 => 'FJ',
            3 => 'FF',
            4 => 'CC',
            0 => null
        ];
        foreach($classesProd as $item) {
            $item = (array) $item;
            $item['tenant_id'] = 2;
            $item['modality_id'] = $item['modality_id'] + 2;
            $item['evolution_date'] = (!empty($item['evolution'])) ? $item['updated_at'] : null;



            $item['class_reposition_id'] = $item['classes_id'];
            unset($item['classes_id']);


            $item['main_instructor_id'] = $item['scheduled_instructor_id'];
            unset($item['scheduled_instructor_id']);

            $item['situation'] = $situation[$item['status']];
            $item['status'] = ($item['status'] != 0) ? 1 : 0;
            
            $item['comments'] = $item['absense_comments'];

            if($item['situation'] == 'FJ') {
                $item['reposition_date_limit'] = date('Y-m-d', strtotime($item['date'] . ' + 1 months'));
            }
            
            unset($item['finished']);
            unset($item['absense_comments']);
            unset($item['has_replacement']);
            unset($item['replacement_limit']);
            unset($item['weekday']);
            DB::connection($local)->table('classes')->insert($item);
        }

        DB::connection($local)->statement("UPDATE classes SET has_reposition = 1 where id in (SELECT class_reposition_id FROM classes WHERE class_reposition_id IS NOT NULL)");

        // Forma Pagamento
        foreach($paymentsProd as $item) {
            $item = (array) $item;
            DB::connection($local)->table('payment_methods')->insert($item);
        }

        // Mensalidades
        foreach($transactionsProd as $item) {
            $item = (array) $item;
            $item['tenant_id'] = 2;
            $item['category_id'] = 1;

            $item['original_value'] = $item['value'];
            
            
            

            unset($item['user_id']);
            unset($item['amount']);
            DB::connection($local)->table('transactions')->insert($item);
        }

        DB::connection($local)->table('tenant_users')->insert(['user_id' => 3, 'tenant_id' => 2]);

        DB::connection($local)->statement("update registrations set modality_id = 3 where id in (SELECT id FROM registrations where student_id <> 25 and modality_id = 4)");
        DB::connection($local)->statement("update classes set modality_id = 3 where id in (SELECT id FROM classes where student_id <> 25 and modality_id = 4)");
        DB::connection($local)->statement("update registrations set is_active = 0 where end < '2023-10-17'");

        DB::connection($local)->statement("
            update classes a
            inner join (
                select a.id, c.name, c.phone_wpp from classes a inner join students b on a.student_id = b.id inner join users c on c.id = b.user_id
                where a.type = 'AE'
            ) b on a.id = b.id
            set 
                a.name = b.name,
                a.phone_wpp = b.phone_wpp");
        
        DB::connection($local)->statement("update classes set student_id = null where registration_id is null and type = 'AE';");
        DB::connection($local)->statement("UPDATE transactions SET student_id = 37 WHERE student_id = 35;");
        DB::connection($local)->statement("create TEMPORARY TABLE tmp_user select user_id from students where id not in (select student_id from registrations);");
        DB::connection($local)->statement("delete from students where id not in (select student_id from registrations);");
        DB::connection($local)->statement("delete from users where id in (select user_id from tmp_user);");
        DB::connection($local)->statement(" drop table tmp_user;");
        DB::connection($local)->statement(" update registrations set is_active = 1 where id = 7");

            
            


            

            

            

  
        
        DB::unprepared('SET FOREIGN_KEY_CHECKS=1');

        // dd($usersProd, $usersLocal);
    }
}
