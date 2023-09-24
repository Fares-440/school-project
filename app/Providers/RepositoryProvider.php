<?php

namespace App\Providers;

use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\FeeInvoicesRepositoryInterface;
use App\Interfaces\StudentGraduatedRepositoryInterface;
use App\Interfaces\StudentPromotionRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\FeesRepositoryInterface;
use App\Interfaces\LibraryRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Interfaces\QuestionRepositoryInterface;
use App\Interfaces\QuizzRepositoryInterface;
use App\Interfaces\ReceiptStudentsRepositoryInterface;
use App\Interfaces\SubjectRepositoryInterface;
use App\Repository\AttendanceRepository;
use App\Repository\FeeInvoicesRepository;
use App\Repository\FeesRepository;
use App\Repository\LibraryRepository;
use App\Repository\PaymentRepository;
use App\Repository\ProcessingFeeRepository;
use App\Repository\QuestionRepository;
use App\Repository\QuizzRepository;
use App\Repository\ReceiptStudentsRepository;
use App\Repository\StudentGraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepository;
use App\Repository\SubjectRepository;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentPromotionRepositoryInterface::class, StudentPromotionRepository::class);
        $this->app->bind(StudentGraduatedRepositoryInterface::class, StudentGraduatedRepository::class);
        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);
        $this->app->bind(FeeInvoicesRepositoryInterface::class, FeeInvoicesRepository::class);
        $this->app->bind(ReceiptStudentsRepositoryInterface::class, ReceiptStudentsRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class, ProcessingFeeRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(QuizzRepositoryInterface::class, QuizzRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(LibraryRepositoryInterface::class, LibraryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
