@extends('templates.mail-main')

@section('body')

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader"></span>
                    <table class="main">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <h1>Registration Verification</h1>
                                            <p>Hi there,</p>
                                            <p>Please verify your Email <b>{{ $userData['email'] }}</b></p>
                                            <p>by Clicking on the Button below</p>
                                            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                                <tbody>
                                                    <tr>
                                                        <td align="left">
                                                            <table border="0" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <a href="{{ $userData['link'] }}" target="_blank">Verification</a> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
@endsection