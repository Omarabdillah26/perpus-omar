@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold">Kelola Anggota (Siswa)</h2>
        <p class="text-secondary">Daftar siswa yang terdaftar sebagai anggota perpustakaan.</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $index => $member)
                        <tr>
                            <td class="ps-4 text-secondary">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold">{{ $member->name }}</div>
                            </td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.members.destroy', $member) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus anggota ini? semua data peminjaman terkait akan tetap tersimpan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm border-0">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-secondary italic">Belum ada siswa yang mendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
