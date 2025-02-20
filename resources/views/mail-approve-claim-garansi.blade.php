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
                                            <p>Selamat! Claim Garansi Produk {{ $userData['brand'] !== 'ESR' ? ucfirst(strtolower($userData['brand'])) : $userData['brand'] }} Anda dengan Nomor Garansi '{{ $userData['nomor_garansi'] }}' telah disetujui.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>
@endsection