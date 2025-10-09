<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kit->name }} - Detalles</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .debug-info { background-color: #f8f9fa; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; }
        .courses-section { margin-top: 20px; }
        ul { padding-left: 20px; }
    </style>
</head>
<body>
    <h1>{{ $kit->name }}</h1>

    <p>ID: {{ $kit->id }}</p>

    <a href="{{ route('robotics.edit', $kit->id) }}">Edit</a>

    <hr>
    <div class="courses-section">
        <h2>Courses attached</h2>
        
        <div class="debug-info">
            <p><strong>Debug:</strong> 
            @if(isset($kit->courses))
                Hay {{ count($kit->courses) }} cursos disponibles.
            @else
                La propiedad courses no está definida.
            @endif
            </p>
        </div>

        <ul>
            @if(isset($kit->courses) && count($kit->courses) > 0)
                @foreach($kit->courses as $course)
                    <li>{{ $course->course_name }}</li>
                @endforeach
            @else
                <li>No courses attached</li>
            @endif
        </ul>
    </div>
    <form action="{{ route('robotics.destroy', $kit->id) }}" method="POST">
        @csrf
        @method('delete')
        
        <input type="submit" name="name" value="Delete record">
    </form>
</body>
</html>