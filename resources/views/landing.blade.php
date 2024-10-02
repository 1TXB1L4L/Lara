<x-drugdept.layout title="HMS Sahiwal Teaching Hospital">
  <div class="bg-gray-100 min-h-screen">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
      <div class="container mx-auto px-4 text-center">
        <i class="fas fa-hospital-alt text-6xl mb-6"></i>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Sahiwal Teaching Hospital</h1>
        <p class="text-xl mb-8">Transforming healthcare with innovative solutions</p>
        @if (Auth::check())
          <a href="{{ route('expense.index') }}" class="bg-white text-blue-600 hover:bg-blue-100 font-bold py-3 px-6 rounded-full transition duration-300">
            Manage Expenses
          </a>
        @else
          <a href="{{ route('login') }}" class="bg-white text-blue-600 hover:bg-blue-100 font-bold py-3 px-6 rounded-full transition duration-300">
            Login
          </a>
        @endif
      </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">About Us</h2>
        <p class="max-w-2xl mx-auto text-gray-600 leading-relaxed">
          At Sahiwal Teaching Hospital, we combine cutting-edge technology with compassionate care to provide exceptional healthcare services. Our dedicated team ensures personalized attention and optimal outcomes for every patient.
        </p>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-100">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-12 text-gray-800">Key Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          @foreach ([
            ['icon' => 'fas fa-user-md', 'title' => 'Patient Management', 'description' => 'Efficiently manage patient records, appointments, and medical history.'],
            ['icon' => 'fas fa-chart-line', 'title' => 'Data Analytics', 'description' => 'Gain insights from data to improve treatment efficacy and patient outcomes.'],
            ['icon' => 'fas fa-comments', 'title' => 'Secure Messaging', 'description' => 'Communicate securely with patients and staff without concerns.'],
          ] as $feature)
            <div class="bg-white p-6 rounded-lg shadow-md">
              <i class="{{ $feature['icon'] }} text-4xl text-blue-600 mb-4"></i>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $feature['title'] }}</h3>
              <p class="text-gray-600">{{ $feature['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="bg-indigo-600 py-16 text-center">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-white mb-6">Join Us Today!</h2>
        @if (Auth::check())
          <a href="{{ route('expense.index') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-3 px-6 rounded-full transition duration-300">
            Manage Expenses
          </a>
        @else
          <a href="{{ route('login') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-3 px-6 rounded-full transition duration-300">
            Login
          </a>
        @endif
      </div>
    </section>
  </div>

  <style>
    @media (max-width: 768px) {
      .text-4xl {
        font-size: 2.5rem;
      }
      .text-xl {
        font-size: 1.25rem;
      }
    }
  </style>
</x-drugdept.layout>
