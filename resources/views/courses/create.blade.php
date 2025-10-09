<h1>Create a new Course</h1>

<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    
    <label>Course Key *</label>
    <input type="text" name="course_key" required />
    
    <label>Course Name *</label>
    <input type="text" name="course_name" required />
    
    <label>Robotics Kit *</label>
    <select name="robotics_kit_id" required>
        <option value="">Select a Kit</option>
        @foreach($kits as $kit)
            <option value="{{ $kit->id }}">{{ $kit->name }}</option>
        @endforeach
    </select>

    <input type="submit" value="Create" />
</form>