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
                                            <p>Halo {{ $userData['nama'] }},</p>
                                            <p>Mohon maaf! Registrasi Garansi Produk {{ $userData['brand'] !== 'ESR' ? ucfirst(strtolower($userData['brand'])) : $userData['brand'] }} Anda dengan Nomor Garansi '{{ $userData['nomor_garansi'] }}' tidak disetujui.</p>
                                            <p>Silahkan hubungi Customer Service untuk informasi lebih lanjut.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
@endsection