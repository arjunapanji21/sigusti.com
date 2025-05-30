@extends('layouts.guest')

@section('content')
    
<!-- Hero Section -->
<div class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-r from-green-500 to-green-600">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,...');"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                Automate Your <span class="text-green-100">WhatsApp</span> Experience
            </h2>
            <p class="mt-6 text-xl md:text-2xl text-white opacity-90 max-w-3xl mx-auto">
                Streamline your messaging workflow with powerful automation tools
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center text-center sm:text-left">
                <a href="{{route('signup')}}" class="inline-flex items-center justify-center sm:justify-start px-8 py-4 rounded-lg text-green-600 bg-white hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span class="text-lg font-semibold">Get Started Free</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="#about" class="inline-flex items-center justify-center sm:justify-start px-8 py-4 rounded-lg text-white border-2 border-white hover:bg-white/10 transition-all duration-300">
                    <span class="text-lg font-semibold">Learn More</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div id="about" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900">
                    About AutoWhatsApp.web.id
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    AutoWhatsApp.web.id is a powerful desktop application designed to enhance your WhatsApp Web experience. Our tool helps businesses and individuals automate their messaging workflow, save time, and improve communication efficiency.
                </p>
                <div class="mt-8">
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-gray-600">User-friendly interface</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-gray-600">Secure and reliable</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-3 text-gray-600">Regular updates and support</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 lg:mt-0">
                <img class="rounded-lg shadow-xl" src="{{asset('screenshots/main-menu.png')}}" alt="Auto WhatsApp Web Main Menu">
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div id="features" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold gradient-text">
                Powerful Bulk Messaging Solution
            </h2>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                Send thousands of messages daily with our intelligent anti-ban technology
            </p>
        </div>
        
        <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="100">
                <div class="text-green-600 mb-4">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900">High-Volume Messaging</h3>
                <p class="mt-2 text-gray-600">Send up to 10,000 messages per day with our optimized delivery system. Perfect for large-scale campaigns.</p>
            </div>
            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="200">
                <div class="text-green-600 mb-4">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900">Advanced Safety Features</h3>
                <p class="mt-2 text-gray-600">Our intelligent system mimics human behavior to keep your account safe. Lowest ban rate in the industry.</p>
            </div>
            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="300">
                <div class="text-green-600 mb-4">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900">Simple Yet Powerful</h3>
                <p class="mt-2 text-gray-600">Start sending bulk messages in minutes with our intuitive interface. No technical skills required.</p>
            </div>
        </div>

        <!-- Added Benefits Section -->
        <div class="mt-16 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full">
                <span class="text-green-600 font-medium">Why Choose Us?</span>
            </div>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-4">
                    <div class="text-4xl font-bold text-green-600">99.9%</div>
                    <p class="mt-2 text-gray-600">Delivery Success Rate</p>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-green-600">&lt;0.1%</div>
                    <p class="mt-2 text-gray-600">Account Ban Rate</p>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-green-600">10K+</div>
                    <p class="mt-2 text-gray-600">Messages Per Day</p>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-green-600">24/7</div>
                    <p class="mt-2 text-gray-600">Technical Support</p>
                </div>
            </div>
        </div>

        <div class="w-full pt-10 lg:pt-20 flex justify-center items-center">
            <img class="shadow-xl" src="{{asset('screenshots/main-window.png')}}" alt="Auto WhatsApp Web Interface">
        </div>
    </div>
</div>

<!-- Pricing Section -->
<div id="pricing" class="py-12 md:py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold gradient-text">Affordable Plans for Everyone</h2>
            <p class="mt-4 text-lg text-gray-600">Choose the plan that best fits your needs</p>
            
            <!-- Billing Toggle -->
            <div x-data="{ yearly: false }" @toggle-pricing.window="yearly = !yearly">
                <div class="mt-8 flex justify-center items-center gap-4">
                    <span :class="!yearly ? 'text-gray-900 font-semibold' : 'text-gray-500'">Monthly</span>
                    <button type="button" 
                            @click="$dispatch('toggle-pricing')"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            :class="yearly ? 'bg-green-600' : 'bg-gray-200'">
                        <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                              :class="yearly ? 'translate-x-5' : 'translate-x-0'"></span>
                    </button>
                    <span :class="yearly ? 'text-gray-900 font-semibold' : 'text-gray-500'">
                        Yearly
                        <span class="ml-1.5 inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Save 20% more</span>
                    </span>
                </div>

                <div class="mt-12 flex flex-col lg:flex-row gap-8 justify-center items-center">
                    @foreach($plans as $plan)
                        <div class="bg-white w-full lg:w-1/3 rounded-lg shadow-lg overflow-hidden relative {{ $loop->iteration === 2 ? 'border-2 border-green-500' : '' }}">
                            @if($loop->iteration === 2 && $plan->isOnSale())
                                <div class="absolute animate-pulse -top-5 left-0 right-0 flex justify-center">
                                    <span class="pt-5 inline-flex h-11 items-center px-4 rounded-full text-sm font-semibold bg-red-500 text-white shadow-sm">
                                        Limited Time Offer!
                                    </span>
                                </div>
                            @endif

                            <div class="px-6 py-8">
                                <h3 class="text-2xl font-semibold text-gray-900">{{ $plan->name }}</h3>
                                <p class="mt-4 text-gray-600">{{ $plan->description ?? 'Perfect for ' . strtolower($plan->name) . ' users' }}</p>
                                
                                <div class="mt-8 space-y-4">
                                    <div class="transition-all duration-300 transform">
                                        <div x-show="!yearly" x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0">
                                            <span class="text-4xl font-extrabold text-gray-900">{{ $plan->monthly_price_formatted }}</span>
                                            <span class="text-xl text-gray-500">/month</span>
                                            @if($plan->isOnSale())
                                                <div class="mt-2">
                                                    <span class="text-lg text-gray-500 line-through">{{ $plan->original_price_formatted }}</span>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        {{ $plan->discount_badge }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div x-show="yearly" x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0 translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0">
                                            <span class="text-4xl font-extrabold text-gray-900">{{ $plan->yearly_price_formatted }}</span>
                                            <span class="text-xl text-gray-500">/year</span>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Save Rp.{{ number_format(($plan->monthly_price * 12) - $plan->yearly_price) }} yearly
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <ul class="mt-8 space-y-4">
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="ml-3">Up to {{ number_format($plan->daily_limit) }} messages/day</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="ml-3">Up to {{ number_format($plan->monthly_limit) }} messages/month</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        @if($plan->max_device > 1)
                                            <span class="ml-3">Up to {{ $plan->max_device }} devices</span>
                                        @else
                                            <span class="ml-3">Only 1 device</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="px-6 py-4">
                                <a href="{{ route('signup') }}" 
                                   class="block w-full text-center px-4 py-2 {{ $loop->iteration === 2 ? 'bg-green-600 text-white hover:bg-green-700' : 'border border-green-600 text-green-600 hover:bg-green-50' }} rounded-md">
                                    Get Started
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div id="testimonials" class="bg-gray-100 py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Dipercaya oleh 1000+ Pebisnis Indonesia
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Bergabung dengan ribuan pebisnis sukses yang telah meningkatkan omset mereka dengan Auto WhatsApp Web
            </p>
            <div class="mt-6 flex justify-center gap-8 text-sm text-gray-500">
                <div>
                    <span class="block text-2xl font-bold text-green-600">50.000+</span>
                    Pesan Terkirim/Hari
                </div>
                <div>
                    <span class="block text-2xl font-bold text-green-600">97%</span>
                    Tingkat Kepuasan
                </div>
                <div>
                    <span class="block text-2xl font-bold text-green-600">24/7</span>
                    Dukungan Teknis
                </div>
            </div>
        </div>

        <div class="mt-12" x-data="{ 
            currentSlide: 0,
            autoplayInterval: null,
            isDragging: false,
            startX: 0,
            currentX: 0,
            dragOffset: 0,
            testimonials: [
                { 
                    initials: 'AF',
                    name: 'Ahmad Fadillah',
                    role: 'Dropshipper',
                    text: 'Gak nyesel subscribe premium. Fitur blast message bisa kirim ribuan pesan sekaligus dan ada laporan status delivery. Worth it banget!',
                    company: 'AF Dropship Store',
                    datePublished: '2023-12-10',
                    rating: 5,
                    location: 'Jakarta, Indonesia'
                },
                { 
                    initials: 'RS',
                    name: 'Rudi Setiawan',
                    role: 'Owner UMKM',
                    text: 'Aplikasinya ringan dan mudah digunakan. Bisa broadcast ke semua pelanggan dengan sekali klik!',
                    company: 'RS Fashion',
                    datePublished: '2023-12-15',
                    rating: 5,
                    location: 'Bandung, Indonesia'
                },
                { 
                    initials: 'NH',
                    name: 'Nia Handayani',
                    role: 'Social Media Manager',
                    text: 'Fitur importnya keren, bisa langsung kirim ke banyak nomor sekaligus. Sangat membantu untuk campaign marketing.',
                    company: 'Digital Marketing Agency',
                    datePublished: '2023-12-20',
                    rating: 5,
                    location: 'Surabaya, Indonesia'
                },
                { 
                    initials: 'IP',
                    name: 'Irfan Pratama',
                    role: 'E-commerce Seller',
                    text: 'Recommended banget buat yang jualan online. Follow up customer jadi lebih gampang dan cepat.',
                    company: 'IP Online Shop',
                    datePublished: '2023-12-25',
                    rating: 5,
                    location: 'Medan, Indonesia'
                },
                { 
                    initials: 'SM',
                    name: 'Siti Maryam',
                    role: 'Business Owner',
                    text: 'Customer service jadi lebih efisien, bisa handle banyak chat sekaligus. Top markotop!',
                    company: 'SM Beauty Care',
                    datePublished: '2023-12-28',
                    rating: 5,
                    location: 'Yogyakarta, Indonesia'
                },
                { 
                    initials: 'HG',
                    name: 'Hendra Gunawan',
                    role: 'Digital Marketing',
                    text: 'Value for money banget. Investasi yang worth it untuk scaling bisnis online.',
                    company: 'HG Digital Solutions',
                    datePublished: '2023-12-30',
                    rating: 5,
                    location: 'Semarang, Indonesia'
                }
            ],
            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.nextSlide();
                }, 5000); // Change slide every 5 seconds
            },
            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                }
            },
            init() {
                this.startAutoplay();
                this.$watch('currentSlide', () => {
                    // Reset timer when manually changed
                    this.stopAutoplay();
                    this.startAutoplay();
                });
            },

            handleTouchStart(e) {
                this.isDragging = true;
                this.startX = e.type === 'mousedown' ? e.pageX : e.touches[0].pageX;
                clearInterval(this.autoplayInterval);
            },

            handleTouchMove(e) {
                if (!this.isDragging) return;
                const x = e.type === 'mousemove' ? e.pageX : e.touches[0].pageX;
                const diff = this.startX - x;
                if (Math.abs(diff) > 50) {
                    this.isDragging = false;
                    if (diff > 0) {
                        this.nextSlide();
                    } else {
                        this.prevSlide();
                    }
                }
            },

            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.testimonials.length;
            },

            prevSlide() {
                this.currentSlide = this.currentSlide === 0 
                    ? this.testimonials.length - 1 
                    : this.currentSlide - 1;
            }
        }" 
        class="relative">
            <!-- Schema.org Review Markup -->
            <script type="application/ld+json" x-data x-text="JSON.stringify({
                '@context': 'https://schema.org',
                '@type': 'Organization',
                'name': 'AutoWhatsApp.web.id',
                'review': testimonials.map(t => ({
                    '@type': 'Review',
                    'reviewRating': {
                        '@type': 'Rating',
                        'ratingValue': '5'
                    },
                    'author': {
                        '@type': 'Person',
                        'name': t.name,
                        'jobTitle': t.role,
                        'worksFor': {
                            '@type': 'Organization',
                            'name': t.company
                        }
                    },
                    'reviewBody': t.text,
                    'datePublished': t.datePublished
                }))
            })">
            </script>

            <!-- Slider container with improved accessibility -->
            <div class="overflow-hidden" 
                 role="region" 
                 aria-label="Customer Testimonials"
                 @mouseenter="stopAutoplay()"
                 @mouseleave="startAutoplay()">
                <div class="relative flex transition-transform duration-500 ease-in-out transform"
                     style="width: 100%;"
                     :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                    
                    <template x-for="(testimonial, index) in testimonials" :key="index">
                        <div class="w-full flex-shrink-0 px-4">
                            <div class="max-w-2xl mx-auto">
                                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-500"
                                     :class="currentSlide === index ? 'scale-100 opacity-100' : 'scale-95 opacity-75'"
                                     role="article">
                                    <div class="flex items-center">
                                        <div class="h-16 w-16 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white mr-4 font-bold text-xl" 
                                             x-text="testimonial.initials"></div>
                                        <div class="flex-1">
                                            <h4 class="text-xl font-semibold" x-text="testimonial.name"></h4>
                                            <p class="text-sm text-gray-500" x-text="testimonial.role + ' | ' + testimonial.company"></p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <time class="text-xs text-gray-400" 
                                                      :datetime="testimonial.datePublished" 
                                                      x-text="new Date(testimonial.datePublished).toLocaleDateString()"></time>
                                                <span class="text-xs text-gray-400" x-text="testimonial.location"></span>
                                            </div>
                                            <div class="mt-2 flex items-center gap-1">
                                                <template x-for="star in 5">
                                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-6 text-lg text-gray-600 leading-relaxed" x-text="testimonial.text"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            <!-- Navigation dots with improved accessibility -->
            <div class="flex justify-center gap-2 mt-6" role="tablist">
                <template x-for="(_, index) in testimonials" :key="index">
                    <button @click="currentSlide = index"
                            class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                            :class="currentSlide === index ? 'bg-green-600 w-6' : 'bg-gray-300 hover:bg-gray-400'"
                            :aria-label="`View testimonial ${index + 1}`"
                            :aria-selected="currentSlide === index"
                            role="tab"></button>
                </template>
            </div>
        </div>
    </div>
</div>

<!-- Download Section -->
<div id="download" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">
            Ready to Get Started?
        </h2>
        <p class="mt-4 text-lg text-gray-600">
            Download AutoWhatsApp.web.id now and transform your messaging experience
        </p>
        <div class="mt-8">
            <a href="{{route('signin')}}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                Download for Windows
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>

@endsection