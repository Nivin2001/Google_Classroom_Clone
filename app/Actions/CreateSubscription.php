<?PHP
namespace App\Actions;

use App\Models\subscription;

class CreateSubscription
{


    public function __invoke(array $date) : subscription
    {

         /** */
        * @parm $date array
        *@return \APP\Models\subscription


         */
        return Subscription::forceCreate($date)
    }

}
