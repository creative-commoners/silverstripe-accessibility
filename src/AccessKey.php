<?php

namespace Silverstripe\AccessKeys;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class AccessKey extends DataExtension
{
    const DB_FIELD_NAME = 'AccessKey';

    public static $db = [
        self::DB_FIELD_NAME => 'Varchar(1)',
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $description = _t(
            'Silverstripe\AccessKeys\AccessKey.LABEL',
            'Access Keys are optional, but must be a single unique character.'
            . 'Check your current access keys to avoid conflict'
        );
        $title = _t('Silverstripe\AccessKeys\AccessKey.TITLE', 'Access Key');

        $fields->addFieldToTab(
            'Root.Settings',
            TextField::create(self::DB_FIELD_NAME, $title)->setMaxLength(1)->setDescription($description)
        );
    }

    public function getAccessKeys()
    {
        return SiteTree::get()
            ->exclude(self::DB_FIELD_NAME, '')
            ->sort(self::DB_FIELD_NAME, 'ASC');
    }

    // TODO: Add a form validation step that verifies that there isn't a duplicate access key.
}
