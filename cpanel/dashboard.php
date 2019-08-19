<?php 
require_once '../core/init.php';
$admin = new Admin();
if(!$admin->isLoggedIn()) Redirect::to('index'); ?>
<?php View::start('head') ?>
<?php View::end('head') ?>
<div class="container mt-5">
    <div class="card ">
        <table class="table table-striped table-bordered table-active table-hover">
        <thead>
            <tr>
                <th>Students</th>
                <th>Arabic</th>
                <th>English</th>
                <th>Hebrew</th>
                <th>Math</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user =  new User();
            $grades = Subject::getAll();
            foreach($grades as $grade)
            {
                echo '<tr>';
                $u = $user->find($grade->user_id); 
                    echo '<td>'.$u->name.'</td>';
                    echo '<td>'.$grade->arabic.'</td>';
                    echo '<td>'.$grade->english.'</td>';
                    echo '<td>'.$grade->hebrew.'</td>';
                    echo '<td>'.$grade->math.'</td>';
                echo '</tr>';
            }
             ?>
        </tbody>
    </table>
    </div>
</div>

<?php View::start('body') ?>
<?php View::end('body') ?>