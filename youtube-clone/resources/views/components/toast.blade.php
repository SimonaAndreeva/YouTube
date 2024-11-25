use Illuminate\Support\Facades\Blade;

public function boot()
{
    Blade::component('toast', \App\View\Components\Toast::class);
}
