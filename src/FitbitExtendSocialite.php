<?php
namespace SocialiteProviders\Fitbit;

use SocialiteProviders\Manager\SocialiteWasCalled;

class FitbitExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'fitbit',
            __NAMESPACE__.'\Provider',
            __NAMESPACE__.'\Server'
        );
    }
}
