<h1>{{ $course->course_name }}</h1>

<p>ID: {{ $course->id }}</p>
<p>Course Key: {{ $course->course_key }}</p>
<p>Robotics Kit: {{ $course->roboticsKit->name }}</p>

<a href="{{ route('courses.edit', $course->id) }}">Edit</a>

<form action="{{ route('courses.destroy', $course->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
</form>