<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="modal fade" id="createModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="create">
                        <div class="mb-3">
                            <label class="form-label">Nama Guru</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control" wire:model="nip">
                            @error('nip') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mapel</label>
                            <input type="text" class="form-control" wire:model="mapel">
                            @error('mapel') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelamin</label>
                            <select class="form-control" wire:model="kelamin">
                                <option value="">-- Pilih Kelamin --</option>
                                <option value=0>Laki-Laki</option>
                                <option value=1>Perempuan</option>
                            </select>
                            @error('kelamin') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <div wire:ignore>
                            <select class="selectkelas" multiple wire:model="kelas">
                                @foreach ($kelasdatas as $data)
                                <option value="{{$data->id}}">{{$data->nama}}</option>
                                @endforeach
                            </select>
                            </div>
                            @error('kelas') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <input type="file" wire:model="foto">
                        @if ($foto)
                            <img src="{{ $foto->temporaryUrl() }}" width="200">
                        @endif

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
     
    <div class="container-fluid py-6">
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Guru</a>
        @foreach ($kelasdatas as $kelas)
            <div class="mt-4">
                <h3 class="text-primary">{{ $kelas->nama }}</h3>
                <div class="row">
                    @foreach ($gurudatas->where('kelas', '!=', null) as $guru)
                        @if($guru->kelas->contains('id', $kelas->id)) 
                            <div class="col-md-3 p-3">
                                <div class="card shadow-lg rounded-lg border" style="width: 100%;">
                                    <img class="card-img-top" src="{{ is_null($guru->foto) ? asset('assets/img/teachimg.png') :  asset('storage/' . $guru->foto)}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $guru->nama }}</h5>
                                        <p class="card-text">
                                            <strong>NIP:</strong> {{ $guru->nip }} <br>
                                            <strong>Kelamin:</strong> {{ $guru->kelamin == 1 ? 'Perempuan' : 'Laki-laki' }} <br>
                                            <strong>Mapel:</strong> {{ $guru->mapel}} <br>
                                        </p>
                                    </div>
                                    <div class="container text-center">
                                        <div class="row justify-content-md-center">
                                            <div class="col p-3">
                                                <a data-bs-toggle="modal" wire:click="edit({{ $guru->id }})" data-bs-target="#editModal{{$guru->id}}" class="btn btn-primary">Edit</a>
                                            </div>
                                            <div class="col p-3">
                                                <a wire:click="delete({{ $guru->id }})" class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editModal{{$guru->id}}" tabindex="-1" wire:ignore.self>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Guru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form wire:submit.prevent="update">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Guru</label>
                                                    <input type="text" class="form-control" wire:model="nama">
                                                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">NIP</label>
                                                    <input type="text" class="form-control" wire:model="nip">
                                                    @error('nip') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Kelamin</label>
                                                    <select class="form-control" wire:model="kelamin">
                                                        <option value="">-- Pilih Kelamin --</option>
                                                        <option value="0">Laki-Laki</option>
                                                        <option value="1">Perempuan</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Kelas</label>
                                                    <div wire:ignore>
                                                    <select class="selectkelas" multiple wire:model="kelas">
                                                        @foreach ($kelasdatas as $data)
                                                        <option value="{{$data->id}}">{{$data->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>

                                                <input type="file" wire:model="foto">
                                                @if ($foto)
                                                    <img src="{{ $foto->temporaryUrl() }}" width="200">
                                                @endif

                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

@script
 <script>
    $wire.on('closeModal', () => {
      
        $('#createModal').modal('hide');
        $('.modal').modal('hide');
              
    });

    document.addEventListener("livewire:initialized", () => {
    $(".selectkelas").select2({
        placeholder: "Select Kelas",
        allowClear: true
    })
        .on("change", function () {
                const values = $(this).val();
                console.log(values);
                @this.set('kelas', values);
        });
    });

    $(".selectkelamin").select2({
    });
 </script>
@endscript
