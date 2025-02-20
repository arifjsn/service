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
                                            <h1>{{ $userData['brand'] !== 'ESR' ? ucfirst(strtolower($userData['brand'])) : $userData['brand'] }}</h1>
                                            <p>Halo {{ $userData['nama']}},</p>
                                            <p>Selamat! Registrasi Garansi produk {{ $userData['brand'] !== 'ESR' ? ucfirst(strtolower($userData['brand'])) : $userData['brand'] }} Anda sudah diterima, berikut terlampir nomor garansi dari sistem.</p><br>
                                            <p>Nomor Garansi: <b>{{ $userData['nomor_garansi'] }}</b></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
@endsection