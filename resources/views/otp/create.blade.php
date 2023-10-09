<x-front-layout>

    <!-- Titlebar
================================================== -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>Send Verify Code</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs" class="dark">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Log In</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>


    <!-- Page Content
================================================== -->
    <div class="container">
        <div class="row">
            <div class="col-xl-5 offset-xl-3">


                <div class="login-register-page">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>We're glad to see you again!</h3>
                    </div>

                    <!-- Session Status -->
 
                    <!-- Validation Errors -->
 
                    <!-- Form -->
                    <form method="post" action="{{ route('otp.create') }}" >
                        @csrf
                        <div class="input-with-icon-left">
                            <i class="icon-material-baseline-mail-outline"></i>
                            <input type="text" class="input-text with-border" name="mobile_number"  placeholder="Mobile Number" required />
                        </div>
                        <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" >Send Code <i class="icon-material-outline-arrow-right-alt"></i></button>

                    </form>

                    <!-- Button -->

                </div>

            </div>
        </div>
    </div>


    <!-- Spacer -->
    <div class="margin-top-70"></div>
    <!-- Spacer / End-->

</x-front-layout>