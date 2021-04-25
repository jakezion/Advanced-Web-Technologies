<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>


    <div class="d-flex justify-content-center">
        <div class="col-6 mt-5 px-5 register-main ">
            <div class="mb-2">
                <h1 class="d-flex justify-content-center">Register Account</h1>
            </div>
            <?php if (session()->has('success')): ?>
                <div class="mb-2">
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success'); ?>

                    </div>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="mb-2">
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div id="form"></div>
        </div>
    </div>

<?= $this->endSection(); ?>

    <style>
        .register-main {
            font-family: 'Arvo', sans-serif;
        }

        .register-main input {
            font-size: 22px;
        }
    </style>

<?= $this->section('scripts'); ?>
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <script type="text/babel">

        class MultiForm extends React.Component {
            constructor(props) {
                super(props);
                this.state = {
                    username: '',
                    phone: '',
                    email: '',
                    password: '',
                    usernameError: '',
                    phoneError: '',
                    emailError: '',
                    passwordError: '',
                };

                this.handleUsername = this.handleUsername.bind(this);
                this.handlePhone = this.handlePhone.bind(this);
                this.handleEmail = this.handleEmail.bind(this);
                this.handlePassword = this.handlePassword.bind(this);
                this.handleSubmit = this.handleSubmit.bind(this);


            }


            handleUsername(event) {
                this.setState({username: event.target.value}, () => {
                    this.validateUsername();
                });
            }


            handlePhone(event) {
                this.setState({phone: event.target.value}, () => {
                    this.validatePhoneNumber();
                });
            }


            handleEmail(event) {
                this.setState({email: event.target.value}, () => {
                    this.validateEmailAddress();
                });
            }

            handlePassword(event) {
                this.setState({password: event.target.value});
                // let password = this.state.password;
            }

            validateUsername() {
                let username = this.state.username;
                let symbols = new RegExp(/[^a-zA-Z0-9\s]/);
                //let symbols = new RegExp(/^[a-zA-Z0-9!@#$%^&*)(+=._-]*$/);
                if (symbols.test(username)) {
                    this.setState({nameError: 'Your username is invalid.'});
                    //   <style>.invalid{text-color: red;}</style>
                } else {
                    this.setState({nameError: ''});
                    //   <style>.invalid{text-color: black;}</style>
                }
            }

            validatePhoneNumber() {
                let phone = this.state.phone;
                if (phone.length < 10) {
                    this.setState({
                        phoneError: 'Phone must be 10 digits.'
                    });
                } else if (phone.length > 10) {
                    this.setState({
                        phoneError: 'Phone must be 10 digits.'
                    });
                } else if (isNaN(phone)) {
                    this.setState({
                        phoneError: 'Phone must be numeric.'
                    });
                } else {
                    this.setState({
                        phoneError: ''
                    });
                }
            }

            validateEmailAddress() {
                let email = this.state.email;
                let format = new RegExp(/[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}/);
                if (format.test(email)) {
                    this.setState({emailError: ''});
                } else {
                    this.setState({emailError: 'Your Email address isn\'t valid.'});
                }
            }

            validatePassword() {
                let password = this.state.password;
            }

            handleSubmit(event) {


                // $(document).ready(function () {
                //     event.preventDefault();
                //
                //     $.ajax({
                //         url: 'handler.php',
                //         type: 'POST',
                //         data: {
                //             'username': this.state.username,
                //             'phone': this.state.phone,
                //             'email': this.state.email
                //         },
                //         cache: false,
                //         success: function (data) {
                //             this.setState({
                //                 type: 'success',
                //                 message: 'Form received and will be processed'
                //             });
                //             // $('.form-group').slideUp();
                //             // $('.form-group').after(this.state.contactMessage);
                //             console.log('success', data);
                //         }.bind(this),
                //         error: function (xhr, status, err) {
                //             console.log(xhr, status);
                //             console.log(err);
                //             this.setState({
                //                 type: 'danger',
                //                 message: 'Sorry the form encountered an error'
                //             });
                //             console.log(this.state.username + this.state.phone + this.state.email + 'fail');
                //         }.bind(this)
                //     });
                // });
                //alert(this.state.username + this.state.phone + this.state.email + this.state.password);
               // event.preventDefault();

            }

            //TODO: FINSIH FORM VALUES
            render() {
                return (

                    <form onSubmit={this.handleSubmit} method="post" >

                                          <div className="mb-3">
                            <label htmlFor="username"> Username:</label>
                            <div className="input-group">

                                <input
                                    name="username"
                                    type="text"
                                    className={
                                        `form-control ` + `${this.state.nameError ? 'is-invalid' : ''}`}
                                    value={
                                        this.state.username}
                                    id="username"
                                    onChange={this.handleUsername}
                                    onBlur={this.validateUsername}
                                    placeholder="Username"
                                />
                                <div className='invalid-feedback'>{this.state.nameError}</div>
                            </div>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="phone">  Phone Number:</label>
                            <div className="input-group">
                                <span className="input-group-text">+44</span>
                                <input
                                    name="phone"
                                    type="text"
                                    value={this.state.phone}
                                    className={
                                        `form-control ` + `${this.state.phoneError ? 'is-invalid' : ''}`}
                                    id="phone"
                                    onChange={this.handlePhone}
                                    onBlur={this.validatePhoneNumber}
                                    placeholder="Phone Number"
                                />
                                <div className='invalid-feedback'>{this.state.phoneError}</div>
                            </div>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="email"> Email Address:</label>
                            <div className="input-group">
                                <input
                                    name="email"
                                    type="email"
                                    value={
                                        this.state.email}
                                    className={
                                        `form-control ` + `${this.state.emailError ? 'is-invalid' : ''}`}
                                    id="email"
                                    onChange={
                                        this.handleEmail}
                                    onBlur={
                                        this.validateEmailAddress}
                                    placeholder="name@example.co.uk"

                                />
                                <div className='invalid-feedback'>{this.state.emailError}</div>
                            </div>
                        </div>

                        <div className="mb-3">
                            <label htmlFor="password"> Password:</label>
                            <div className="input-group">
                                <input
                                    name="password"
                                    type="password"
                                    className='form-control'
                                    value={
                                        this.state.password}
                                    id="password"
                                    onChange={
                                        this.handlePassword}
                                    onBlur={
                                        this.validatePassword}
                                    placeholder="Password"
                                />

                                <div className='invalid-feedback'>{this.state.passwordError}</div>
                            </div>
                        </div>
                        <div className="d-flex justify-content-center text-center">
                            <button type="submit" className="btn btn-dark mb-3">Register</button>
                        </div>
                    </form>
                );
            }
        }

        ReactDOM.render(
            <MultiForm/>,
            document.getElementById('form')
        );

    </script>

<!--TODO add Confirm password
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Username" aria-label="Username">
  <span class="input-group-text">@</span>
  <input type="text" class="form-control" placeholder="Server" aria-label="Server">
</div>
-->
<?= $this->endSection(); ?>