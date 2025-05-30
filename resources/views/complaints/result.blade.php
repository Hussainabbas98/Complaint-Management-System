<!DOCTYPE html>
<html>

<head>
    <title>Complaint Status</title>
</head>

<body>
    <h2>Complaint Details</h2>

    <p><strong>Complaint ID:</strong> {{ $complaint->complaint_id }}</p>
    <p><strong>Name:</strong> {{ $complaint->name }}</p>
    <p><strong>Email:</strong> {{ $complaint->email }}</p>
    <p><strong>Status:</strong> {{ ucfirst($complaint->status) }}</p>
    <p><strong>Admin Comment:</strong> {{ $complaint->admin_comment ?? 'No comment yet.' }}</p>
</body>

</html>