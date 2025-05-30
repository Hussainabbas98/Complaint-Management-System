<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Complaint Management</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container py-5">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-6">

            <h2 class="text-2xl font-bold mb-4 text-center text-blue-700">📝 Submit a Complaint</h2>

            @if(session('success'))
                <div class="alert alert-success text-green-700 bg-green-100 border border-green-400 rounded p-2 mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/complaints" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="name" class="form-control rounded-md" placeholder="Your Name" required>
                </div>
                <div>
                    <input type="email" name="email" class="form-control rounded-md" placeholder="Your Email" required>
                </div>
                <div>
                    <textarea name="message" rows="4" class="form-control rounded-md" placeholder="Your Complaint"
                        required></textarea>
                </div>
                <div class="text-end">
                    {{-- <button type="submit" class="btn btn-primary rounded-full px-4 py-2">Submit Complaint </button>
                    --}}
                    <button type="submit"
                        class="text-md w-28 h-8 rounded bg-emerald-500 text-white relative overflow-hidden group z-10 hover:text-white duration-1000">
                        <span
                            class="absolute bg-emerald-600 w-36 h-36 rounded-full group-hover:scale-100 scale-0 -z-10 -left-2 -top-10 group-hover:duration-500 duration-700 origin-center transform transition-all"></span>
                        <span
                            class="absolute bg-emerald-800 w-36 h-36 -left-2 -top-10 rounded-full group-hover:scale-100 scale-0 -z-10 group-hover:duration-700 duration-500 origin-center transform transition-all"></span>
                        Submit
                    </button>

                </div>
            </form>

            <hr class="my-6">

            <h2 class="text-2xl font-bold mb-4 text-center text-purple-700">🔍 Track Complaint Status</h2>

            @if(session('error'))
                <div class="alert alert-danger text-red-700 bg-red-100 border border-red-400 rounded p-2 mb-3">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/track-complaint" class="d-flex flex-column gap-3">
                @csrf
                <input type="text" name="complaint_id" class="form-control rounded-md" placeholder="Enter Complaint ID"
                    required>
                {{-- <button type="submit" class="btn btn-success rounded-full">Check Status</button> --}}
                <div class="text-end">
                    <button type="submit"
                        class="text-md w-28 h-8 rounded bg-emerald-500 text-white relative overflow-hidden group z-10 hover:text-white duration-1000">
                        <span
                            class="absolute bg-emerald-600 w-36 h-36 rounded-full group-hover:scale-100 scale-0 -z-10 -left-2 -top-10 group-hover:duration-500 duration-700 origin-center transform transition-all"></span>
                        <span
                            class="absolute bg-emerald-800 w-36 h-36 -left-2 -top-10 rounded-full group-hover:scale-100 scale-0 -z-10 group-hover:duration-700 duration-500 origin-center transform transition-all"></span>
                        Check Status
                    </button>
                </div>
            </form>

            @if(session('complaint_status'))
                @php $complaint = session('complaint_status'); @endphp
                <div class="mt-6 p-4 border rounded-lg bg-gray-50 shadow-inner">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">📄 Status Result</h3>
                    <p><strong class="text-gray-700">ID:</strong> {{ $complaint->complaint_id }}</p>
                    <p><strong class="text-gray-700">Status:</strong> <span
                            class="badge bg-info text-dark">{{ ucfirst($complaint->status) }}</span></p>
                    <p><strong class="text-gray-700">Admin Comment:</strong>
                        {{ $complaint->admin_comment ?? 'No comment yet.' }}</p>
                </div>
            @endif

        </div>
    </div>

</body>

</html>