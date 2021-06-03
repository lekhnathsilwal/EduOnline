<?php 
    use Illuminate\Support\Facades\Auth;
    use App\Student;
        if(Auth::guard('student')->user()->email_verified_at == NULL){
            // return redirect()->intended('/verifyStudent'); 
            ?>
            <script type="text/javascript">
                window.location = "{{ url('/verifyStudent') }}";//here double curly bracket
            </script> <?php
        }
        else{
        }
    ?>