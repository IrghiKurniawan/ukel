@extends('templates.app')

@section('content')
    <style>
        body {
            background-color: rgb(255, 255, 255);
        }
    </style>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Perhatian!</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-secondary text-white text-center">
                        <h4>Formulir Keluhan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data"
                            class="max-w-sm mx-auto">
                            @csrf

                            <div class="mb-3">
                                <label for="province"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi*</label>
                                <select id="province" name="province"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="regency"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota/Kabupaten*</label>
                                <select id="regency" name="regency"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subdistrict"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan*</label>
                                <select id="subdistrict" name="subdistrict"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="vilage"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelurahan*</label>
                                <select id="vilage" name="vilage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type*</label>
                                <select id="type" name="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="KEJAHATAN">Kejahatan</option>
                                    <option value="PEMBANGUNAN">Pembangunan</option>
                                    <option value="SOSIAL">Sosial</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail
                                    Keluhan*</label>
                                <textarea id="description" name="description"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                                    Pendukung*</label>
                                <input type="file" id="image" name="image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    required>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    id="statement" name="statement" required>
                                <label for="statement"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laporan sesuai dengan
                                    kebenaran.</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-green-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load provinsi
            $.getJSON(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`, function(data) {
                $.each(data, function(key, val) {
                    $('#province').append('<option value="' + val.id + '">' + val.name +
                        '</option>');
                });
            });

            // On change provinsi
            $('#province').change(function() {
                const provinceId = $(this).val();
                $('#regency').prop('disabled', true).html('<option value="">Pilih Kota/Kabupaten</option>');
                $('#subdistrict').prop('disabled', true).html('<option value="">Pilih Kecamatan</option>');
                $('#vilage').prop('disabled', true).html('<option value="">Pilih Kelurahan</option>');

                if (provinceId) {
                    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provinceId +
                        '.json',
                        function(data) {
                            $('#regency').prop('disabled', false);
                            $.each(data, function(key, val) {
                                $('#regency').append('<option value="' + val.id + '">' + val
                                    .name + '</option>');
                            });
                        });
                }
            });

            // On change kabupaten
            $('#regency').change(function() {
                const regencyId = $(this).val();
                $('#subdistrict').prop('disabled', true).html('<option value="">Pilih Kecamatan</option>');
                $('#vilage').prop('disabled', true).html('<option value="">Pilih Kelurahan</option>');

                if (regencyId) {
                    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + regencyId +
                        '.json',
                        function(data) {
                            $('#subdistrict').prop('disabled', false);
                            $.each(data, function(key, val) {
                                $('#subdistrict').append('<option value="' + val.id + '">' + val
                                    .name + '</option>');
                            });
                        });
                }
            });

            // On change kecamatan
            $('#subdistrict').change(function() {
                const districtId = $(this).val();
                $('#vilage').prop('disabled', true).html('<option value="">Pilih Kelurahan</option>');

                if (districtId) {
                    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + districtId +
                        '.json',
                        function(data) {
                            $('#vilage').prop('disabled', false);
                            $.each(data, function(key, val) {
                                $('#vilage').append('<option value="' + val.id + '">' + val
                                    .name + '</option>');
                            });
                        });
                }
            });
        });
    </script>
