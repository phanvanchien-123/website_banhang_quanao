<?php
 
namespace App\Composers;
 
// use App\Repositories\UserRepository;
use App\Models\Photo;
use Illuminate\View\View;
use App\Models\FooterLink;
 
class ViewCompose
{
    /**
     * Create a new profile composer.
     */
    protected $logo;
    protected $FLink;

    public function __construct(Photo $logo,FooterLink $FLink) {
        $this->logo = $logo;
        $this->FLink = $FLink;

    }
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'logo' => $this->logo->where('type', 'logo')->first(),
            'FLink' => $this->FLink->all()
        ]);
    }
}