<h1>Courses</h1>

<a href="/courses/create">Create</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Key</th>
            <th>Name</th>
            <th>Robotics Kit</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->course_key }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->roboticsKit->name }}</td>
                <td>
                    <a href="{{ route('courses.show', $course->id) }}">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>