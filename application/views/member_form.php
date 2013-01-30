<?php if ($connected === TRUE) { redirect(site_url()/message); } ?>

<section class="row-fluid">
    <section class="span5">
        <h2>Log in to your account</h2>

       <?php  if(isset($error)) : ?> 
        <section class="alert alert-error">
           <h4>Warning!</h4>
             <p><?php echo $error; ?></p>
              <p><a href="<?php echo site_url(); ?>" title="Go to home page">Back to home</a></p>
        </section>
       <?php endif;  ?>

        <?php
            //form igniter
            echo form_open('member/login', array('methodes' => 'post'));
            echo form_label('Your name OR your email', 'nameLogin');
            $emailInput = array(
                'name' => 'nameLogin',
                'id' => 'nameLogin',
                'placeholder' => 'Enter your name or your email here'
            );
            echo form_input($emailInput);
            
            
            echo form_label('Your password', 'mdpLogin');
            $passwordInput = array(
                'name' => 'mdpLogin',
                'id' => 'mdpLogin',
                'type' => 'password',
                'placeholder' => 'Enter your name here'
            );
            echo form_input($passwordInput);
            
            echo '<br />';
            
            $checkInput = array(
                'name' => 'check',
                'id' => 'check',
                'value' => 'Log in !',
                'class' => 'btn'
                );
            echo form_submit($checkInput); 
            echo form_close();
        
        ?>
    </section>

    <section class="span5 offset2" id="signForm">
        <h2>Create a new account</h2>
        <?php  if(isset($successful)) : ?> 
        <section class="alert alert-success">
           <h4>Well done!</h4>
             <p><?php echo $successful; ?></p>
              <p><a href="<?php echo site_url(); ?>" title="Go to home page">Back to home</a></p>
        </section>
       <?php endif;  ?>
        
        <?php  if(isset($erreur)) : ?> 
        <section class="alert alert-error">
           <h4>Warning!</h4>
             <p><?php echo validation_errors(); ?></p>
              <p><a href="<?php echo site_url(); ?>" title="Go to home page">Back to home</a></p>
        </section>
       <?php endif;  ?>

        <?php
            //form igniter
            echo form_open('member/signup', array('methodes' => 'post'));
            echo form_label('Your name', 'nom');
            $nomInput = array(
                'name' => 'nom',
                'id' => 'nom',
                'value' => set_value('nom'),
                'placeholder' => 'Enter your name here'
            );
            echo form_input($nomInput);
            
             echo form_label('Your email', 'email');
            $emailInput = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'email',
                'value' => set_value('email'),
                'placeholder' => 'Enter your email here'
            );
            echo form_input($emailInput);
            
            
            echo form_label('Your password', 'mdp');
            $passwordInput = array(
                'name' => 'mdp',
                'id' => 'mdp',
                'type' => 'password',
                'placeholder' => 'Enter your name here'
            );
            echo form_input($passwordInput);

            echo form_label('Confirm your password', 'mdp_confirm');
            $passwordConfirmInput = array(
                'name' => 'mdp_confirm',
                'id' => 'mdp_confirm',
                'type' => 'password',
                'placeholder' => 'Enter your name here'
            );
            echo form_input($passwordConfirmInput);
            
            echo '<br />';
            
            $signInput = array(
                'name' => 'signIn',
                'id' => 'signIn',
                'value' => 'Sign in !',
                'class' => 'btn'
                );
            echo form_submit($signInput); 
            echo form_close();
        ?>
    </section>
</section>
