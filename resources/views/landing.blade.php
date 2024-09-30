<x-drugdept.layout title="HMS Sahiwal Teaching Hospital">
  <div class="container mx-auto pt-10">
    <!-- Hero Section -->
    <section class="hero is-fullheight bg-gradient-to-r from-blue-800 to-purple-900 flex items-center justify-center text-center p-10">
      <div>
        <i class="fas fa-hospital fa-8x text-white mb-4"></i>
        <h1 class="title is-1 text-white font-bold">Welcome to Sahiwal Teaching Hospital</h1>
        <h2 class="subtitle is-4 text-white mb-6">Transforming healthcare with our innovative solutions</h2>
        @if (Auth::check())
          <a href="{{ route('expense.index') }}" class="button is-large is-info is-rounded transition duration-300">Let's do Expense</a>
          @else
          <a href="{{ route('login') }}" class="button is-large is-info is-rounded transition duration-300">Login</a>
        @endif
      </div>
    </section>

    <div class="py-10"></div> <!-- Space after navbar -->

    <!-- About Section -->
    <section class="py-20 bg-gray-100 text-center">
      <h2 class="text-3xl font-bold mb-6">About Us</h2>
      <p class="max-w-2xl mx-auto text-gray-700 leading-relaxed">
        At Sahiwal Teaching Hospital, we provide exceptional healthcare services through advanced technology and compassionate care. Our dedicated team ensures every patient receives personalized attention and optimal outcomes.
      </p>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20 shadow-md">
      <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-10">Key Features</h2>
        <div class="flex flex-wrap justify-center">
          @foreach ([
            ['icon' => 'fas fa-user-md', 'title' => 'Patient Management', 'description' => 'Efficiently manage patient records, appointments, and medical history.'],
            ['icon' => 'fas fa-chart-line', 'title' => 'Data Analytics', 'description' => 'Gain insights from data to improve treatment efficacy and patient outcomes.'],
            ['icon' => 'fas fa-comments', 'title' => 'Secure Messaging', 'description' => 'Communicate securely with patients and staff without concerns.'],
          ] as $feature)
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
              <i class="{{ $feature['icon'] }} fa-5x text-blue-600 mb-2"></i>
              <h3 class="text-lg font-bold mb-2">{{ $feature['title'] }}</h3>
              <p class="text-gray-600">{{ $feature['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="cta bg-orange-500 py-20 text-center">
      <h2 class="title is-2 text-2xl font-bold text-white">Join Us Today!</h2>
      <br>
      @if (Auth::check())
          <a href="{{ route('expense.index') }}" class="button is-large is-rounded font-bold transition duration-300 ease-in-out hover:bg-white hover:text-orange-500">Let's do Expense</a>
      @else
          <a href="{{ route('login') }}" class="button is-large is-rounded font-bold transition duration-300 ease-in-out hover:bg-white hover:text-orange-500">Login</a>
      @endif
    </section>
  </div>

  <style>
    .button {
      padding: 1rem 2rem; /* Adjust button padding */
      font-weight: bold; /* Make text bold */
      border: 2px solid transparent; /* Add border */
      transition: background-color 0.3s ease, border-color 0.3s ease; /* Transition for hover effects */
    }

    .button.is-danger {
      background-color: #e53e3e; /* Custom danger button color */
      color: white;
    }

    .button.is-dark {
      background-color: #4a5568; /* Custom dark button color */
      color: white;
    }

    .button:hover {
      background-color: #fff; /* White background on hover */
      color: #4a5568; /* Dark text on hover */
      border-color: #4a5568; /* Dark border on hover */
    }

    @media (max-width: 768px) {
      .hero i {
        font-size: 6rem; /* Adjust icon size for mobile */
      }
      .title.is-1 {
        font-size: 2rem; /* Adjust title size for mobile */
      }
      .subtitle.is-4 {
        font-size: 1.5rem; /* Adjust subtitle size for mobile */
      }
    }
  </style>
</x-drugdept.layout>
