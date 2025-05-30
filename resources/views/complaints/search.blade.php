<!DOCTYPE html>
<html>
<head>
    <title>Track Complaint</title>
</head>
<body>
    <h2>Track Your Complaint</h2>

    @if(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/complaint-status">
        @csrf
        <input type="text" name="complaint_id" placeholder="Enter Complaint ID" required>
        <button type="submit">Check Status</button>
    </form>
</body>
</html>
