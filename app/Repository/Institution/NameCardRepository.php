<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/4/17
 * Time: 12:08 PM
 */

namespace App\Repository\Institution;


use App\Models\Institution;
use App\Models\NameCard;

class NameCardRepository
{
    private $nameCard;


    /**
     * @param NameCard $nameCard
     */
    public function __construct(NameCard $nameCard)
    {
        $this->nameCard = $nameCard;

    }

    public function all($request)
    {
        $nameCardUsers = $this->nameCard;
        if ($request->has('institution_id') && $request->institution_id != null) {
            $nameCardUsers = $nameCardUsers->where('institution_id', '=', $request->institution_id);

        }
        if ($request->has('name_card_person') && $request->name_card_person != null) {
            $nameCardUsers = $nameCardUsers->where('name_card_person', 'LIKE', $request->name_card_person . '%');

        }
        if ($request->has('name_card_address') && $request->name_card_address != null) {
            $nameCardUsers = $nameCardUsers->where('name_card_address', 'LIKE', $request->name_card_address . '%');

        }
        if ($request->has('name_card_contact_number1') && $request->name_card_contact_number1 != null) {
            $nameCardUsers = $nameCardUsers->where('name_card_contact_number1', '=', $request->name_card_contact_number1);

        }

        return $nameCardUsers
            ->orderBy('name_card_person', 'ASC')
            ->get();
    }

    public function getNameCardByInstitution($institution_id)
    {
        return $institution = NameCard::where('institution_id', '=', $institution_id);

    }

    public function getCardUserNames($request)
    {
        $names = $this->nameCard
            ->where('name_card_person', 'LIKE', $request->name . '%')
            ->orderBy('name_card_person', 'ASC')

            ->get();
        foreach ($names as $name) {
            $namePerson[] = '<option>' . $name->name_card_person . '</option>';
        }
        return json_encode($namePerson);
    }

}