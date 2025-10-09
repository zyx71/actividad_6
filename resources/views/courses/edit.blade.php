<h1>Edit {{ $course->course_name }}</h1>

<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PATCH')
    
    <label>Course Key *</label>
    <input type="text" name="course_key" value="{{ $course->course_key }}" required>
    
    <label>Course Name *</label>
    <input type="text" name="course_name" value="{{ $course->course_name }}" required>
    
    <label>Robotics Kit *</label>
    <select name="robotics_kit_id" required>
        @foreach($kits as $kit)
            <option value="{{ $kit->id }}" {{ $course->robotics_kit_id == $kit->id ? 'selected' : '' }}>{{ $kit->name }}</option>
        @endforeach
    </select>

    <input type="submit" value="Update">
</form>