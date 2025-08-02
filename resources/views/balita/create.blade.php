<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <a href="{{ route('balita.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Tambah Data Balita</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Isi form untuk menambahkan data balita baru
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white shadow sm:rounded-lg">
                <form action="{{ route('balita.store') }}" method="POST" class="space-y-6 p-6" x-data="balitaForm()">
                    @csrf
                    
                    <!-- Quick Select from Existing Data -->
                    @if(auth()->user()->isAdmin())
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-blue-900 mb-3">Pilih dari Data Existing (Opsional)</h3>
                        <select id="existing-balita-select" class="w-full">
                            <option value="">Pilih balita existing untuk mengisi form otomatis</option>
                        </select>
                        <p class="mt-2 text-xs text-blue-700">
                            Sebagai admin, Anda dapat memilih data balita yang sudah ada untuk mengisi form secara otomatis
                        </p>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Nama Balita -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Balita')" />
                            <x-text-input id="name" 
                                          name="name" 
                                          type="text" 
                                          class="mt-1 block w-full" 
                                          :value="old('name')" 
                                          required 
                                          autofocus 
                                          autocomplete="name"
                                          placeholder="Masukkan nama balita"
                                          x-model="formData.name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                            <select id="gender-select" 
                                    name="gender" 
                                    required 
                                    x-model="formData.gender"
                                    class="mt-1 block w-full">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>👦 Laki-laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>👧 Perempuan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tgl_lahir" 
                                          name="tgl_lahir" 
                                          type="date" 
                                          class="mt-1 block w-full" 
                                          :value="old('tgl_lahir')" 
                                          required 
                                          max="{{ date('Y-m-d') }}"
                                          x-model="formData.tgl_lahir" />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
                        </div>

                        <!-- Nama Ibu -->
                        <div>
                            <x-input-label for="ibu" :value="__('Nama Ibu')" />
                            <x-text-input id="ibu" 
                                          name="ibu" 
                                          type="text" 
                                          class="mt-1 block w-full" 
                                          :value="old('ibu')" 
                                          required 
                                          autocomplete="name"
                                          placeholder="Masukkan nama ibu"
                                          x-model="formData.ibu" />
                            <x-input-error class="mt-2" :messages="$errors->get('ibu')" />
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <x-secondary-button type="button" onclick="window.location='{{ route('balita.index') }}'">
                            {{ __('Batal') }}
                        </x-secondary-button>
                        
                        <x-primary-button class="ml-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Simpan Data Balita') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function balitaForm() {
            return {
                formData: {
                    name: '{{ old('name') }}',
                    gender: '{{ old('gender') }}',
                    tgl_lahir: '{{ old('tgl_lahir') }}',
                    ibu: '{{ old('ibu') }}'
                },
                
                init() {
                    this.initSelect2Components();
                    @if(auth()->user()->isAdmin())
                    this.initExistingBalitaSelect();
                    @endif
                },
                
                initSelect2Components() {
                    // Initialize Gender Select2
                    $('#gender-select').select2({
                        placeholder: 'Pilih jenis kelamin...',
                        allowClear: true,
                        minimumResultsForSearch: Infinity, // Hide search box for gender
                        templateResult: function(option) {
                            if (!option.id) return option.text;
                            return $(`<span>${option.text}</span>`);
                        },
                        templateSelection: function(option) {
                            return option.text || 'Pilih jenis kelamin...';
                        }
                    }).on('select2:select select2:clear', (e) => {
                        this.formData.gender = e.target.value || '';
                    });
                },
                
                @if(auth()->user()->isAdmin())
                initExistingBalitaSelect() {
                    $('#existing-balita-select').select2({
                        placeholder: 'Cari nama balita atau nama ibu...',
                        allowClear: true,
                        ajax: {
                            url: '{{ route('api.balita.search') }}',
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term,
                                    page: params.page || 1
                                };
                            },
                            processResults: function (data, params) {
                                params.page = params.page || 1;
                                
                                return {
                                    results: data.data.map(item => ({
                                        id: item.id,
                                        text: `${item.name} - ${item.gender == 'L' ? 'Laki-laki' : 'Perempuan'} (${item.ibu}) - ${item.user.name}`,
                                        data: item
                                    })),
                                    pagination: {
                                        more: data.pagination ? data.pagination.more : false
                                    }
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2,
                        templateResult: function(repo) {
                            if (repo.loading) {
                                return $(`<div class="flex items-center"><div class="animate-spin rounded-full h-4 w-4 border-b-2 border-green-500 mr-2"></div>Mencari...</div>`);
                            }
                            
                            if (!repo.data) {
                                return repo.text;
                            }
                            
                            const data = repo.data;
                            const birthDate = new Date(data.tgl_lahir);
                            const age = new Date().getFullYear() - birthDate.getFullYear();
                            const genderIcon = data.gender == 'L' ? '👦' : '👧';
                            
                            return $(`
                                <div class="select2-result-balita">
                                    <div class="select2-result-balita__avatar">${genderIcon}</div>
                                    <div class="select2-result-balita__meta">
                                        <div class="select2-result-balita__name">${data.name}</div>
                                        <div class="select2-result-balita__description">
                                            Ibu: ${data.ibu} | Umur: ~${age} tahun | Owner: ${data.user.name}
                                        </div>
                                    </div>
                                </div>
                            `);
                        },
                        templateSelection: function(repo) {
                            if (!repo.data) {
                                return repo.text || 'Pilih balita existing...';
                            }
                            
                            const data = repo.data;
                            const genderIcon = data.gender == 'L' ? '👦' : '👧';
                            return `${genderIcon} ${data.name} (${data.ibu})`;
                        }
                    }).on('select2:select', (e) => {
                        const selectedData = e.params.data.data;
                        this.populateForm(selectedData);
                    }).on('select2:clear', () => {
                        this.clearForm();
                    });
                },
                @endif
                
                populateForm(data) {
                    this.formData.name = data.name;
                    this.formData.gender = data.gender;
                    this.formData.tgl_lahir = data.tgl_lahir;
                    this.formData.ibu = data.ibu;
                    
                    // Update Select2 components
                    $('#gender-select').val(data.gender).trigger('change');
                },
                
                clearForm() {
                    this.formData = {
                        name: '',
                        gender: '',
                        tgl_lahir: '',
                        ibu: ''
                    };
                    
                    // Clear Select2 components
                    $('#gender-select').val('').trigger('change');
                }
            }
        }
    </script>
    <style>
        /* Select2 Custom Styles */
        .select2-container {
            width: 100% !important;
        }
        
        .select2-container--default .select2-selection--single {
            height: 42px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 6px 12px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
            padding: 0;
            color: #374151;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9ca3af;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
            right: 10px;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #ecfdf5 !important;
            color: #065f46 !important;
        }
        
        .select2-dropdown {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 6px 12px;
        }
        
        .select2-search--dropdown .select2-search__field:focus {
            border-color: #10b981;
            outline: none;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        
        /* Existing Balita Select Styles */
        .select2-result-balita {
            display: flex;
            align-items: center;
            padding: 8px;
        }
        
        .select2-result-balita__avatar {
            font-size: 20px;
            margin-right: 12px;
        }
        
        .select2-result-balita__meta {
            flex: 1;
        }
        
        .select2-result-balita__name {
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }
        
        .select2-result-balita__description {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }
        
        /* Loading animation */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
    @endpush
</x-app-layout>
