<h1>{{ $course->course_name }}</h1>

<p>ID: {{ $course->id }}</p>
<p>Course Key: {{ $course->course_key }}</p>

@if($course->image)
<p>
    <img src="{{ asset('courses_files/' . basename($course->image)) }}" 
         alt="{{ $course->course_name }}" width="200">
</p>
@endif

<p>Robotics Kit: {{ $course->roboticsKit->name }}</p>

<a href="{{ route('courses.edit', $course->id) }}">Edit</a>

<form action="{{ route('courses.destroy', $course->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
</form>
