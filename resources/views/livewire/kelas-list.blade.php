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
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
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
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Class</a>
        <div class="row">
            @foreach ($kelasdatas as $kelas)
                <div class="col-md-4 p-3">
                    <div class="card shadow-lg rounded-lg border" style="width: 100%;">
                        <img class="card-img-top" src="{{ asset('assets/img/classroompict.jpg') }}">
                        <div class="card-body">
                            <h5 class="card-title">{{$kelas -> nama}}</h5>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-md-center">
                                <div class="col p-3">
                                    <a href="{{ route('kelas-info', $kelas->id) }}" class="btn btn-primary">View</a>
                                </div>
                                <div class="col p-3">
                                    <a data-bs-toggle="modal" wire:click="edit({{ $kelas->id }})" data-bs-target="#editModal{{$kelas->id}}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col p-3">
                                    <a wire:click="delete({{ $kelas->id }})" class="btn btn-primary">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{$kelas->id}}" tabindex="-1" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="update">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kelas</label>
                                        <input type="text" class="form-control" wire:model="nama">
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
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
      
      $('#createModal').modal('show');
      $('#editModal{{$kelas->id}}').modal('show');
       
    });
 </script>
@endscript
