<h1>Create a new Robotics Kit</h1>

<form action="{{ route('robotics.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <label>Name *</label>
    <input type="texte" name="name" required />

    <br><br>

    <label>Image *</label>
    <input type="file" name="image" required />

    <br><br>

    <input type="submit" value="Create" />
</form>