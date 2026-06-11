<form method="POST" action="/api/applications/1/status">
    @csrf
    @method('PUT')

    <input
        type="text"
        name="status"
        placeholder="accepted or rejected"
    >

    <button type="submit">
        Update
    </button>
</form>