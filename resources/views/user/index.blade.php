@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-red-700">Daftar User</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow border border-red-100">
            <thead>
                <tr class="bg-red-50 text-red-700">
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-red-50">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-xs
                            @if($user->role=='admin') bg-red-100 text-red-700
                            @else bg-red-50 text-red-600 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
