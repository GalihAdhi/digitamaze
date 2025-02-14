<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">List Kelas, Guru, dan Murid</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guru</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Murid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelasdatas as $kelas)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm text-primary">{{ $kelas->nama }}</h6>
                                            </td>
                                            <td>
                                                @if($kelas->guru->isEmpty())
                                                    <span class="text-muted">Belum ada guru</span>
                                                @else
                                                @foreach ($kelas->guru as $guru)
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ is_null($guru->foto) ? asset('assets/img/teachimg.png') :  asset('storage/' . $guru->foto)}}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $guru->nama }}</h6>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $guru->mapel }}</p>
                                                            <span class="badge badge-sm bg-gradient-success">{{ $guru->nip }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if($kelas->murid->isEmpty())
                                                    <span class="text-muted">Belum ada murid</span>
                                                @else
                                                    @foreach ($kelas->murid as $murid)
                                                    <p class="text-sm mb-1">
                                                        <strong>{{ $murid->nama }}</strong> - 
                                                        {{ $murid->kelamin == 1 ? 'Perempuan' : 'Laki-laki' }}
                                                    </p>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $kelasdatas->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">List Guru per Kelas</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Guru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gurudatas as $gurus)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm text-primary">{{ $gurus->nama }}</h6>
                                        </td>
                                        <td>
                                            @foreach ($gurus->guru as $guru)
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ is_null($guru->foto) ? asset('assets/img/teachimg.png') :  asset('storage/' . $guru->foto)}}"
                                                            class="avatar avatar-sm me-3 border-radius-lg"
                                                            alt="guru">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $guru->nama }}</h6>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $guru->mapel }}</p>
                                                        <span class="badge badge-sm bg-gradient-success">{{ $guru->nip }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $gurudatas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">List Murid per Kelas</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Kelas</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Nama Murid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($muriddatas as $murids)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm text-primary">{{ $murids->nama }}</h6>
                                        </td>
                                        <td>
                                            @foreach ($murids->murid as $murid)
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ is_null($murid->foto) && $murid->kelamin === 1 ? asset('assets/img/femstudimg.jpg') : 
                                                                    (is_null($murid->foto) && $murid->kelamin === 0 ? asset('assets/img/malestudimg.jpg') :  
                                                                    asset('storage/' . $murid->foto)) }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg"
                                                            alt="murid">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $murid->nama }}</h6>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $murid->wali->nama }}</p>
                                                        <span class="badge badge-sm bg-gradient-success">{{ $murid->nip }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $muriddatas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>