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
                    <h5 class="modal-title">Add Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="create">
                        <div class="mb-3">
                            <label class="form-label">Nama Murid</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" wire:model="nim">
                            @error('nim') <span class="text-danger">{{ $message }}</span> @enderror
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
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Siswa</a>
        <div class="row">
            @foreach ($muriddatas as $murid)
                <div class="col-md-4 p-3">
                    <div class="card shadow-lg rounded-lg border" style="width: 100%;">
                        <img class="card-img-top" src="{{ is_null($murid->foto)&& $murid->kelamin === 1 ? asset('assets/img/femstudimg.jpg') : (is_null($murid->foto)&& $murid->kelamin === 0 ? asset('assets/img/malestudimg.jpg') :  asset('storage/' . $murid->foto  ) )}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$murid -> nama}}</h5>
                            <p class="card-text">
                                <strong>NIM:</strong> {{ $murid->nim }} <br>
                                <strong>Kelamin:</strong> {{ $murid->kelamin == 1 ? 'Perempuan' : 'Laki-laki' }} <br>
                                <strong>Kelas:</strong> 
                                @if($murid->kelas->isNotEmpty())
                                    @foreach($murid->kelas as $kelas)
                                        <span class="badge bg-primary">{{ $kelas->nama }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Belum ada kelas</span>
                                @endif
                            </p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-md-center">
                                <div class="col p-3">
                                    <a data-bs-toggle="modal" wire:click="edit({{ $murid->id }})" data-bs-target="#editModal{{$murid->id}}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col p-3">
                                    <a wire:click="delete({{ $murid->id }})" class="btn btn-primary">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{$murid->id}}" tabindex="-1" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="update">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Murid</label>
                                        <input type="text" class="form-control" wire:model="nama">
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">NIM</label>
                                        <input type="text" class="form-control" wire:model="nim">
                                        @error('nim') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kelamin</label>
                                        <select class="form-control" wire:model="kelamin">
                                            <option value="">-- Pilih Kelamin --</option>
                                            <option value=0>Laki-Laki</option>
                                            <option value=1>Perempuan</option>
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

            @endforeach
        </div>
    </div>
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
