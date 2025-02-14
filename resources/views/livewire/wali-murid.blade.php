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
                    <h5 class="modal-title">Add Wali</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="create">
                        <div class="mb-3">
                            <label class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Murid</label>
                            <select class="form-control" wire:model="id_murid">
                                <option value="">-- Pilih Murid --</option>
                                @foreach ($muriddatas as $murid)
                                <option value="{{$murid->id}}">{{$murid->nama}}</option>
                                @endforeach
                            </select>
                            @error('id_murid') <span class="text-danger">{{ $message }}</span> @enderror
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
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Wali</a>
        <div class="row">
            @foreach ($walidatas as $wali)
                <div class="col-md-3 p-3">
                    <div class="card shadow-lg rounded-lg border" style="width: 100%;">
                        <img class="card-img-top" src="{{ asset('assets/img/teachimg.png') }}">
                        <div class="card-body">
                            <h5 class="card-title">{{$wali -> nama}}</h5>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-md-center">
                                <div class="col p-3">
                                    <a data-bs-toggle="modal" wire:click="edit({{ $wali->id }})" data-bs-target="#editModal{{$wali->id}}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col p-3">
                                    <a wire:click="delete({{ $wali->id }})" class="btn btn-primary">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{$wali->id}}" tabindex="-1" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Wali</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="update">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Wali</label>
                                        <input type="text" class="form-control" wire:model="nama">
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Murid</label>
                                        <select class="form-control" wire:model="id_murid">
                                            <option value="">-- Pilih Murid --</option>
                                            @foreach ($muriddatas as $murid)
                                            <option value="{{$murid->id}}">{{$murid->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_murid') <span class="text-danger">{{ $message }}</span> @enderror
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