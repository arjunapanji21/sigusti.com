<x-app-layout>
    <div class="py-6" x-data="pemeriksaanForm()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <a href="{{ route('pemeriksaan.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Pemeriksaan Baru</h1>
                            <p class="mt-1 text-sm text-gray-600" x-show="!showKpspQuestions">
                                Pilih balita dan masukkan data pengukuran
                            </p>
                            <p class="mt-1 text-sm text-gray-600" x-show="showKpspQuestions">
                                Jawab pertanyaan KPSP untuk <span x-text="localData.nama_balita || ''"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Indicator -->
            <div class="bg-white shadow sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" 
                                     :class="!showKpspQuestions ? 'bg-green-500 text-white' : 'bg-green-100 text-green-500'">
                                    <svg x-show="!showKpspQuestions" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"/>
                                    </svg>
                                    <svg x-show="showKpspQuestions" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium" :class="!showKpspQuestions ? 'text-gray-900' : 'text-gray-500'">
                                    Data Balita & Pengukuran
                                </span>
                            </div>
                            <div class="w-8 border-t-2" :class="showKpspQuestions ? 'border-green-500' : 'border-gray-200'"></div>
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" 
                                     :class="showKpspQuestions ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500'">
                                    <span class="text-sm font-medium">2</span>
                                </div>
                                <span class="text-sm font-medium" :class="showKpspQuestions ? 'text-gray-900' : 'text-gray-500'">
                                    Pertanyaan KPSP
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phase 1: Data Balita & Pengukuran -->
            <div x-show="!showKpspQuestions" class="space-y-6">
                <!-- Data Balita Selection -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Pilih Balita</h3>
                        
                        @if($balita->count() > 0)
                            <div class="mb-6">
                                <label for="balita_select" class="block text-sm font-medium text-gray-700 mb-2">
                                    Cari dan Pilih Balita <span class="text-red-500">*</span>
                                </label>
                                <select id="balita_select" required class="w-full">
                                    <option value="">Ketik untuk mencari nama balita...</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">
                                    Ketik minimal 2 karakter untuk mencari balita berdasarkan nama atau nama ibu
                                </p>
                            </div>

                            <!-- Selected Balita Info -->
                            <div x-show="selectedBalitaInfo" class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-green-900 mb-2">Balita yang Dipilih:</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-gray-700">Nama:</span>
                                        <span x-text="selectedBalitaInfo?.name"></span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Jenis Kelamin:</span>
                                        <span x-text="selectedBalitaInfo?.gender == 'L' ? 'Laki-laki' : 'Perempuan'"></span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Usia:</span>
                                        <span x-text="selectedBalitaInfo?.ageText"></span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data balita</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Anda perlu mendaftarkan balita terlebih dahulu sebelum melakukan pemeriksaan.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('balita.create') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Daftarkan Balita
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Data Pengukuran -->
                @if($balita->count() > 0)
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Data Pengukuran</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="berat" class="block text-sm font-medium text-gray-700 mb-1">
                                    Berat Badan (kg) <span class="text-red-500">*</span>
                                </label>
                                <x-text-input 
                                    id="berat" 
                                    name="berat"
                                    type="number" 
                                    step="0.1"
                                    class="mt-1 block w-full" 
                                    required 
                                    placeholder="Contoh: 12.5"
                                    min="0" 
                                    max="100"
                                    x-model="measurementData.berat" 
                                />
                            </div>

                            <div>
                                <label for="tinggi" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tinggi Badan (cm) <span class="text-red-500">*</span>
                                </label>
                                <x-text-input 
                                    id="tinggi" 
                                    name="tinggi"
                                    type="number" 
                                    step="0.1"
                                    class="mt-1 block w-full" 
                                    required 
                                    placeholder="Contoh: 85.5"
                                    min="0" 
                                    max="200"
                                    x-model="measurementData.tinggi" 
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Continue Button -->
                <div class="flex justify-end" x-show="selectedBalitaInfo">
                    <button type="button" 
                            @click="saveDataAndContinue()"
                            :disabled="!canContinue()"
                            :class="canContinue() ? 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700' : 'bg-gray-300 cursor-not-allowed'"
                            class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Lanjut ke Pertanyaan KPSP
                    </button>
                </div>
                @endif
            </div>

            <!-- Phase 2: KPSP Questions -->
            <div x-show="showKpspQuestions" class="space-y-6">
                <!-- Local Data Summary -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-green-900 mb-2">Data Pemeriksaan:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Nama:</span>
                            <span x-text="localData.nama_balita || ''"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Usia:</span>
                            <span x-text="localData.ageText || ''"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Berat:</span>
                            <span x-text="(localData.berat || '') + ' kg'"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Tinggi:</span>
                            <span x-text="(localData.tinggi || '') + ' cm'"></span>
                        </div>
                    </div>
                </div>

                <!-- KPSP Questions Form -->
                <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Hidden Fields with Local Data -->
                    <input type="hidden" name="balita_id" :value="localData.balita_id || ''">
                    <input type="hidden" name="nama_balita" :value="localData.nama_balita || ''">
                    <input type="hidden" name="gender" :value="localData.gender || ''">
                    <input type="hidden" name="usia_saat_pemeriksaan" :value="localData.usia_saat_pemeriksaan || ''">
                    <input type="hidden" name="berat" :value="localData.berat || ''">
                    <input type="hidden" name="tinggi" :value="localData.tinggi || ''">

                    <!-- Soal Perkembangan -->
                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                Kuisioner Pra Skrining Perkembangan (KPSP)
                                <span class="text-sm font-normal text-gray-500">
                                    - Usia <span x-text="localData.usia_saat_pemeriksaan || ''"></span> bulan
                                </span>
                            </h3>

                            <!-- Loading State -->
                            <div x-show="loading" class="text-center py-8">
                                <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-gray-500 bg-white">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memuat soal KPSP...
                                </div>
                            </div>
                            
                            <!-- Questions -->
                            <div x-show="!loading && soalList.length > 0" class="space-y-6">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                    <p class="text-sm text-blue-800">
                                        <strong>Petunjuk:</strong> Jawab semua pertanyaan berikut berdasarkan kemampuan anak saat ini. 
                                        Pilih "Ya" jika anak dapat melakukan atau "Tidak" jika anak belum bisa melakukan.
                                    </p>
                                </div>
                                
                                <template x-for="(soal, index) in soalList" :key="soal.id">
                                    <div>
                                        <!-- Section Header -->
                                        <div x-show="soal.text.includes('#')" class="mt-6 first:mt-0 mb-4">
                                            <h4 class="text-lg font-semibold text-green-600 border-b border-green-200 pb-2" x-text="soal.text.replace('#', '')"></h4>
                                        </div>
                                        
                                        <!-- Question -->
                                        <div x-show="!soal.text.includes('#')" class="border border-gray-200 rounded-lg p-4 mb-4 bg-white">
                                            <div class="mb-4">
                                                <div class="flex items-start space-x-3">
                                                    <p class="text-sm font-medium text-gray-900 flex-1 leading-relaxed" x-text="soal.text"></p>
                                                </div>
                                            </div>
                                            
                                            <!-- Image if exists -->
                                            <div x-show="soal.gambar" class="mb-4 flex justify-center">
                                                <img :src="'/images/kpsp/' + soal.gambar" :alt="'Gambar soal ' + getQuestionNumber(index)" 
                                                     class="max-w-full h-auto rounded-lg border shadow-sm sm:max-w-sm">
                                            </div>
                                            
                                            <!-- Answer Options - Mobile Friendly -->
                                            <div class="mt-4">
                                                <div class="grid grid-cols-2 gap-3 sm:flex sm:space-x-6 sm:gap-0">
                                                    <label class="relative flex items-center justify-center p-3 border-2 rounded-lg cursor-pointer transition-all duration-200 hover:border-green-300 w-full"
                                                           :class="jawaban[index] == 'Ya' ? 'border-green-500 bg-green-50 text-green-700' : 'border-gray-200 bg-white text-gray-700'">
                                                        <input type="radio" 
                                                               :name="'jawaban_' + index" 
                                                               value="Ya" 
                                                               x-model="jawaban[index]"
                                                               class="sr-only">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 w-5 h-5 border-2 rounded-full mr-3 transition-colors duration-200"
                                                                 :class="jawaban[index] == 'Ya' ? 'border-green-500 bg-green-500' : 'border-gray-300'">
                                                                <div x-show="jawaban[index] == 'Ya'" class="w-full h-full rounded-full bg-white transform scale-50"></div>
                                                            </div>
                                                            <span class="text-sm font-medium">Ya</span>
                                                        </div>
                                                        <div x-show="jawaban[index] == 'Ya'" class="absolute top-1 right-1">
                                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                
                                                    <label class="relative flex items-center justify-center p-3 border-2 rounded-lg cursor-pointer transition-all duration-200 hover:border-red-300 w-full"
                                                           :class="jawaban[index] == 'Tidak' ? 'border-red-500 bg-red-50 text-red-700' : 'border-gray-200 bg-white text-gray-700'">
                                                        <input type="radio" 
                                                               :name="'jawaban_' + index" 
                                                               value="Tidak" 
                                                               x-model="jawaban[index]"
                                                               class="sr-only">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 w-5 h-5 border-2 rounded-full mr-3 transition-colors duration-200"
                                                                 :class="jawaban[index] == 'Tidak' ? 'border-red-500 bg-red-500' : 'border-gray-300'">
                                                                <div x-show="jawaban[index] == 'Tidak'" class="w-full h-full rounded-full bg-white transform scale-50"></div>
                                                            </div>
                                                            <span class="text-sm font-medium">Tidak</span>
                                                        </div>
                                                        <div x-show="jawaban[index] == 'Tidak'" class="absolute top-1 right-1">
                                                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <input type="hidden" name="jawaban_array" :value="JSON.stringify(jawaban)">
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                        <button type="button" 
                                @click="editData()"
                                class="w-full sm:w-auto bg-white py-3 px-6 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali Edit Data
                        </button>
                        
                        <button type="submit" 
                                :disabled="!allQuestionsAnswered()"
                                :class="allQuestionsAnswered() ? 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700' : 'bg-gray-300 cursor-not-allowed'"
                                class="w-full sm:w-auto inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Pemeriksaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function pemeriksaanForm() {
            return {
                showKpspQuestions: false,
                selectedBalitaInfo: null,
                measurementData: {
                    berat: '',
                    tinggi: ''
                },
                localData: {},
                soalList: [],
                jawaban: [],
                loading: false,
                questionCounter: 1,
                
                init() {
                    @if($balita->count() > 0)
                    this.initSelect2();
                    @endif
                },
                
                canContinue() {
                    return this.selectedBalitaInfo && 
                           this.measurementData.berat && 
                           this.measurementData.tinggi;
                },
                
                saveDataAndContinue() {
                    if (!this.canContinue()) return;
                    
                    this.localData = {
                        balita_id: this.selectedBalitaInfo.id,
                        nama_balita: this.selectedBalitaInfo.name,
                        gender: this.selectedBalitaInfo.gender,
                        usia_saat_pemeriksaan: this.selectedBalitaInfo.ageInMonths,
                        ageText: this.selectedBalitaInfo.ageText,
                        berat: this.measurementData.berat,
                        tinggi: this.measurementData.tinggi
                    };
                    
                    this.showKpspQuestions = true;
                    this.loadSoal(this.selectedBalitaInfo.ageInMonths);
                },
                
                editData() {
                    this.showKpspQuestions = false;
                    this.soalList = [];
                    this.jawaban = [];
                },
                
                allQuestionsAnswered() {
                    if (this.soalList.length == 0) return false;
                    let answeredCount = 0;
                    let questionCount = 0;
                    this.soalList.forEach((soal, index) => {
                        if (!soal.text.includes('#')) {
                            questionCount++;
                            if (this.jawaban[index] && this.jawaban[index] != '') {
                                answeredCount++;
                            }
                        }
                    });
                    return questionCount > 0 && answeredCount == questionCount;
                },
                
                initSelect2() {
                    $('#balita_select').select2({
                        placeholder: 'Ketik untuk mencari balita...',
                        allowClear: true,
                        minimumInputLength: 2,
                        ajax: {
                            url: '{{ route('balita.search') }}',
                            dataType: 'json',
                            delay: 300,
                            data: function (params) {
                                return {
                                    q: params.term,
                                    page: params.page || 1
                                };
                            },
                            processResults: function (data, params) {
                                if (!data.success) {
                                    return { results: [], pagination: { more: false } };
                                }
                                return {
                                    results: data.data.map(item => ({
                                        id: item.id,
                                        text: `${item.name} - ${item.gender == 'L' ? 'Laki-laki' : 'Perempuan'} (Ibu: ${item.ibu})`,
                                        data: item
                                    })),
                                    pagination: {
                                        more: data.pagination ? data.pagination.more : false
                                    }
                                };
                            },
                            cache: true
                        },
                        templateResult: function(repo) {
                            if (repo.loading || !repo.data) return repo.text;
                            const data = repo.data;
                            const birthDate = new Date(data.tgl_lahir);
                            const today = new Date();
                            const ageInMonths = (today.getFullYear() - birthDate.getFullYear()) * 12 + 
                                                  (today.getMonth() - birthDate.getMonth());
                            const ageInYears = Math.floor(ageInMonths / 12);
                            const remainingMonths = ageInMonths % 12;
                            let ageText = '';
                            if (ageInYears > 0) {
                                ageText = `${ageInYears} tahun ${remainingMonths} bulan`;
                            } else {
                                ageText = `${remainingMonths} bulan`;
                            }
                            const genderIcon = data.gender == 'L' ? '👦' : '👧';
                            
                            return $(`
                                <div class="select2-result-balita">
                                    <div class="select2-result-balita__avatar">${genderIcon}</div>
                                    <div class="select2-result-balita__meta">
                                        <div class="select2-result-balita__name">${data.name}</div>
                                        <div class="select2-result-balita__description">
                                            Ibu: ${data.ibu} | Usia: ${ageText}
                                            @if(auth()->user()->isAdmin())
                                                | Owner: ${data.user.name}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            `);
                        },
                        templateSelection: function(repo) {
                            if (!repo.data) return repo.text || 'Pilih balita...';
                            
                            const data = repo.data;
                            const genderIcon = data.gender == 'L' ? '👦' : '👧';
                            return `${genderIcon} ${data.name}`;
                        }
                    }).on('select2:select', (e) => {
                        const selectedData = e.params.data.data;
                        this.selectBalita(selectedData);
                    }).on('select2:clear', () => {
                        this.selectedBalitaInfo = null;
                    });
                },
                
                selectBalita(data) {
                    const birthDate = new Date(data.tgl_lahir);
                    const today = new Date();
                    const ageInMonths = (today.getFullYear() - birthDate.getFullYear()) * 12 + 
                                          (today.getMonth() - birthDate.getMonth());
                    const ageInYears = Math.floor(ageInMonths / 12);
                    const remainingMonths = ageInMonths % 12;
                    let ageText = '';
                    if (ageInYears > 0) {
                        ageText = `${ageInYears} tahun ${remainingMonths} bulan`;
                    } else {
                        ageText = `${remainingMonths} bulan`;
                    }
                    this.selectedBalitaInfo = {
                        ...data,
                        ageInMonths: ageInMonths,
                        ageText: ageText
                    };
                },
                
                async loadSoal(ageInMonths) {
                    const usiaBayiMap = {
                        @foreach($usiaBayi as $usia)
                            {{ $usia->rentang }}: {{ $usia->id }},
                        @endforeach
                    };
                    let usiaBayiId = usiaBayiMap[ageInMonths];
                    if (!usiaBayiId) {
                        const availableAges = Object.keys(usiaBayiMap).map(Number).sort((a, b) => a - b);
                        for (let age of availableAges) {
                            if (ageInMonths <= age) {
                                usiaBayiId = usiaBayiMap[age];
                                break;
                            }
                        }
                        if (!usiaBayiId && ageInMonths > Math.max(...availableAges)) {
                            usiaBayiId = usiaBayiMap[Math.max(...availableAges)];
                        }
                    }
                    if (!usiaBayiId) {
                        console.log('No KPSP questions available for age:', ageInMonths, 'months');
                        alert('Tidak ada pertanyaan KPSP yang tersedia untuk usia ' + ageInMonths + ' bulan');
                        return;
                    }
                    this.loading = true;
                    this.soalList = [];
                    this.jawaban = [];
                    this.questionCounter = 1;
                    try {
                        const response = await fetch(`{{ route('pemeriksaan.soal') }}?usia_bayi_id=${usiaBayiId}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
                        const data = await response.json();
                        if (data.success && data.data && data.data.length > 0) {
                            this.soalList = data.data;
                            this.jawaban = new Array(this.soalList.length).fill('');
                            console.log(`Loaded ${this.soalList.length} KPSP questions for age ${ageInMonths} months (usia_bayi_id: ${usiaBayiId})`);
                        } else {
                            console.log('No KPSP questions found for usia_bayi_id:', usiaBayiId);
                            alert('Tidak ada pertanyaan KPSP yang ditemukan untuk usia tersebut');
                        }
                    } catch (error) {
                        console.error('Error loading KPSP questions:', error);
                        alert('Gagal memuat pertanyaan KPSP: ' + error.message);
                        
                        // Fallback: show manual message
                        this.soalList = [];
                    } finally {
                        this.loading = false;
                    }
                },
                
                getQuestionNumber(index) {
                    if (index == 0) this.questionCounter = 1;
                    const soal = this.soalList[index];
                    if (soal && soal.text.includes('#')) {
                        return '';
                    }
                    return this.questionCounter++;
                }
            }
        }
    </script>

    <style>
        .select2-result-balita {
            display: flex;
        }
        
        .select2-result-balita__avatar {
            font-size: 20px;
        }
        
        .select2-result-balita__meta {
            flex: 1;
        }
        
        .select2-result-balita__name {
            font-weight: 600;
        }
        
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #dcfce7 !important;
            color: #166534 !important;
        }
        
        .select2-container {
            font-size: 14px;
        }
        
        .select2-container--default .select2-selection--single {
            height: 38px;
            border-color: #d1d5db;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            padding-left: 12px;
        }
    </style>
    @endpush
</x-app-layout>
