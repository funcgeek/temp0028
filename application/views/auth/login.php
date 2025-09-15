<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ispecs Appeal Jamaica">
    <meta name="author" content="NovPilot">
    <meta name="keyword" content="Eye Clinic, Vision Care, Management, Software, Php, Hms, Accounting">
    <link rel="shortcut icon" href="https://ispecsappeal.com/wp-content/uploads/2025/03/ispecs-logo_sjvcso.png">

    <title>Login - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3BBCC0;
            --secondary-color: #2C3E50;
            --light-blue: #A4D4E4;
            --bg-color: #F5F7FA;
            --text-color: #333;
            --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            height: 100vh;
            overflow-x: hidden;
        }
        
        .left-section {
            flex: 1;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .right-section {
            flex: 1;
            background-color: var(--light-blue);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
        }
        
        .glasses-icon {
            width: 300px;
            height: 300px;
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% {
                transform: translatey(0px);
            }
            50% {
                transform: translatey(-20px);
            }
            100% {
                transform: translatey(0px);
            }
        }
        
        .clinic-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .login-form {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
        }
        
        .login-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 25px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
            outline: none;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(59, 188, 192, 0.2);
        }
        
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: #349fa3;
            transform: translateY(-2px);
        }
        
        .forgot-password {
            text-align: right;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .circle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(59, 188, 192, 0.1);
        }
        
        .circle-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
        }
        
        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            right: 30%;
        }
        
        .circle-3 {
            width: 150px;
            height: 150px;
            top: 20%;
            right: 10%;
            background-color: rgba(59, 188, 192, 0.05);
        }
        
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23A4D4E4" fill-opacity="0.4" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,117.3C672,107,768,117,864,128C960,139,1056,149,1152,144C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-repeat: no-repeat;
        }
        
        .logo {
            height: 60px;
            margin-bottom: 15px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            body {
                flex-direction: column;
                height: auto;
            }
            
            .left-section, .right-section {
                flex: none;
                width: 100%;
                padding: 40px 20px;
            }
            
            .glasses-icon {
                width: 200px;
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="left-section">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        
        <svg class="glasses-icon" viewBox="0 0 700 700" xmlns="http://www.w3.org/2000/svg">
            <circle cx="200" cy="350" r="150" fill="#A4D4E4" stroke="#2C3E50" stroke-width="30"/>
            <circle cx="500" cy="350" r="150" fill="#A4D4E4" stroke="#2C3E50" stroke-width="30"/>
            <rect x="350" y="350" width="100" height="30" rx="15" fill="#2C3E50" transform="rotate(180 350 350)"/>
            <path d="M50 350 C 50 350, 0 350, 0 350" stroke="#2C3E50" stroke-width="30" />
            <path d="M650 350 C 650 350, 700 350, 700 350" stroke="#2C3E50" stroke-width="30" />
        </svg>
        
        <h1 class="clinic-title"><?php echo $this->db->get('settings')->row()->title; ?></h1>
        <p>EMR Portal</p>
    </div>
    
    <div class="right-section">
        <div class="circle circle-3"></div>
        <div class="wave"></div>
        
        <div class="login-form">
            <img class="logo" src="https://ispecsappeal.com/wp-content/uploads/2025/03/ispecs-logo_sjvcso.png" alt="Eye Clinic Logo">
            <h2 class="login-title">Sign In</h2>
            
            <div id="infoMessage"><?php echo $message; ?></div>
            
            <form method="post" action="auth/login">
                <div class="form-group">
                    <input style="height:60px;" type="text" class="form-control" name="identity" placeholder="Email Address" autocomplete="off" required>
                </div>
                
                <div class="form-group">
                    <input style="height:60px;" type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                
                <div class="form-group">
                    <select style="height:60px;" class="form-control" name="location" required>
                        <option value="">Select Location</option>
                        <?php
                        $query = $this->db->get('location');
                        foreach ($query->result() as $location) { ?>
                            <option value="<?php echo $location->name; ?>"><?php echo $location->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <!--<div class="forgot-password">-->
                <!--    <a data-toggle="modal" href="#myModal">Forgot Password?</a>-->
                <!--</div>-->
                
                <button class="btn-login" type="submit">
                    Sign In <i class="fa fa-sign-in"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="auth/forgot_password">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password?</h4>
                    </div>

                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                    </div>
                    
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript placed at the end of the document -->
    <script src="common/js/jquery.js"></script>
    <script src="common/js/bootstrap.min.js"></script>
</body>
</html>