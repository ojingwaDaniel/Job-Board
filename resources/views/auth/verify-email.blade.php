
<x-layout>
    <div class="max-w-xl mx-auto mt-16 p-8 text-center">

        <h1 class="text-2xl font-bold mb-4">
            Verify your email
        </h1>

        <p class="mb-6">
            We have sent a verification link to your email address.
            Please check your inbox and click the link to continue
            to the jobs page.
        </p>

        @if (session('status') === 'verification-link-sent')
            <p class="text-green-600 mb-4">
                A new verification link has been sent.
            </p>
        @endif

        <form method="POST"
              action="{{ route('verification.send') }}">
            @csrf

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">
                Resend verification email
            </button>
        </form>

    </div>
</x-layout>
