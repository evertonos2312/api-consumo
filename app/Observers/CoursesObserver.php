<?php

namespace App\Observers;

use App\Models\Course;

class CoursesObserver
{
    /**
     * Handle the Course "creating" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function creating(Course $course)
    {
        $tipo = $course->tipo ?: 'zoom';
        $course->tipo = $tipo;
    }
}
