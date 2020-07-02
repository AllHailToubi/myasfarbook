<div id="meneu_scroll" style="display: none;"><h1 class="logo navbar-brand"><a title="Travelo - home" href="index.html"><img alt="" src="{{ asset('web/images/logox.jpg')}}"></a></h1></div>
<header id="header" class="navbar-static-top">
    <div class="topnav hidden-xs">
        <div class="container">
            <ul class="quick-menu pull-left">
                <li><a href="#">MY ACCOUNT</a></li>
                <li class="ribbon">
                    <a href="#">Français</a>
                    <ul class="menu mini">
                        <li class="active"><a href="#" title="Français">Français</a></li>
                        <li><a href="#" title="English">English</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="quick-menu pull-right">
                <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
                <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
                <li class="ribbon currency">
                    <a href="#" title="">MAD</a>
                    <ul class="menu mini">
                        <li class="active"><a href="#" title="MAD">MAD</a></li>
                        <li><a href="#" title="USD">USD</a></li>
                        <li><a href="#" title="EUR">EUR</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="main-header">
        
        <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
            Mobile Menu Toggle
        </a>

        <div class="container">
            <h1 class="logo navbar-brand">
                <a href="index.html" title="Travelo - home">
                    <img src="{{ asset('web/images/logox.jpg')}}" alt="Travelo HTML5 Template" />
                </a>
            </h1>
            
            <nav id="main-menu" role="navigation">
                <ul class="menu">
                    <li class="menu-item-has-children">
                        <a href="#">Accueil</a>
                        
                    </li>
                    <li class="menu-item-has-children">
                        <a href="{{route('web.hotels.list')}}">Hôtels</a>
                        
                    </li>

                    <li class="menu-item-has-children">
                        <a href="#">Voyages organisés</a>
                        
                    </li>

                    <li class="menu-item-has-children">
                        <a href="#">Contact</a>
                        
                    </li>

                    

                    

                    
                </ul>
            </nav>
        </div>
        
        <nav id="mobile-menu-01" class="mobile-menu collapse">
            <ul id="mobile-primary-menu" class="menu">
                <li >
                    <a href="#">Accueil</a>
                </li>
                <li >
                    <a href="#">Hôtels</a>
                </li>

                <li >
                    <a href="#">Voyages organisés</a>
                </li>
                <li >
                    <a href="#">Contact</a>
                </li>
                
            </ul>
            
            <ul class="mobile-topnav container">
                <li><a href="#">MY ACCOUNT</a></li>
                <li class="ribbon language menu-color-skin">
                    <a href="#" data-toggle="collapse">Français</a>
                    <ul class="menu mini">
                        <li class="active"><a href="#" title="Français">Français</a></li>
                        <li><a href="#" title="English">English</a></li>
                    </ul>
                </li>
                <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
                <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
                <li class="ribbon currency menu-color-skin">
                    <a href="#">MAD</a>
                    <ul class="menu mini">
                        <li class="active"><a href="#" title="MAD">MAD</a></li>
                        <li><a href="#" title="USD">USD</a></li>
                        <li><a href="#" title="EUR">EUR</a></li>
                    </ul>
                </li>
            </ul>
            
        </nav>
    </div>
    <div id="travelo-signup" class="travelo-signup-box travelo-box">
        <div class="login-social">
            <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
            <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
        </div>
        <div class="seperator"><label>OR</label></div>
        <div class="simple-signup">
            <div class="text-center signup-email-section">
                <a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
            </div>
            <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund olicy, and Host Guarantee Terms.</p>
        </div>
        <div class="email-signup">
            <form>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="first name">
                </div>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="last name">
                </div>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="email address">
                </div>
                <div class="form-group">
                    <input type="password" class="input-text full-width" placeholder="password">
                </div>
                <div class="form-group">
                    <input type="password" class="input-text full-width" placeholder="confirm password">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Tell me about Travelo news
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
                </div>
                <button type="submit" class="full-width btn-medium">SIGNUP</button>
            </form>
        </div>
        <div class="seperator"></div>
        <p>Already a Travelo member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a></p>
    </div>
    <div id="travelo-login" class="travelo-login-box travelo-box">
        <div class="login-social">
            <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
            <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
        </div>
        <div class="seperator"><label>OR</label></div>
        <form>
            <div class="form-group">
                <input type="text" class="input-text full-width" placeholder="email address">
            </div>
            <div class="form-group">
                <input type="password" class="input-text full-width" placeholder="password">
            </div>
            <div class="form-group">
                <a href="#" class="forgot-password pull-right">Forgot password?</a>
                <div class="checkbox checkbox-inline">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </div>
        </form>
        <div class="seperator"></div>
        <p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
    </div>
</header>