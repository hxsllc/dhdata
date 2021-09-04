<?php

namespace App\Models;

class Omeka
{
    public $itemSets;

    /**
     * @return mixed
     */
    public function getItemSets()
    {
        return $this->itemSets;
    }

    static public function createItem($json)
    {
        return true;
    }

    public function getItemTemplate(Record $record)
    {
        return [
            "@context" => "http://metascripta.test/api-context",
            "@type" => "o:Item",
            "o:is_public" => true,
            /*"o:owner" => [
                "@id" => "http://metascripta.test/api/users/" . config('omeka.owner'),
                "o:id" => config('omeka.owner')
            ],*/
            "o:resource_class" => null,
            "o:resource_template" => null,
            "o:title" => $record->mCollection . " " . $record->mCodexNumberNew,
            "o:item_set" => [],
            "o:site" => [
                [
                    "@id" => "http://metascripta.test/api/sites/" . config('omeka.site'),
                    "o:id" => config('omeka.site')
                ]
            ],
            "dcterms:title" => [
                [
                    "type" => "literal",
                    "property_id" => 1,
                    "property_label" => "Title",
                    "is_public" => true,
                    "@value" => $record->mCollection . " " . $record->mCodexNumberNew
                ]
            ],
            "dcterms:publisher" => [
                [
                    "type" => "literal",
                    "property_id" => 5,
                    "property_label" => "Publisher",
                    "is_public" => true,
                    "@value" => "Saint Louis University Libraries"
                ]
            ],
            "dcterms:date" => [
                [
                    "type" => "literal",
                    "property_id" => 7,
                    "property_label" => "Date",
                    "is_public" => true,
                    "@value" => $record->mCentury
                ]
            ],
            "dcterms:identifier" => [
                [
                    "type" => "literal",
                    "property_id" => 10,
                    "property_label" => "Identifier",
                    "is_public" => true,
                    "@value" => $record->mFolderNumber
                ]
            ],
            "dcterms:source" => [
                [
                    "type" => "literal",
                    "property_id" => 11,
                    "property_label" => "Source",
                    "is_public" => true,
                    "@value" => $record->roll
                ]
            ],
            "dcterms:language" => [
                [
                    "type" => "literal",
                    "property_id" => 12,
                    "property_label" => "Language",
                    "is_public" => true,
                    "@value" => $record->mLanguage
                ]
            ],
            "dcterms:coverage" => [
                [
                    "type" => "literal",
                    "property_id" => 14,
                    "property_label" => "Coverage",
                    "is_public" => true,
                    "@value" => $record->mCountry
                ]
            ],
            "dcterms:rights" => [
                [
                    "type" => "literal",
                    "property_id" => 15,
                    "property_label" => "Rights",
                    "is_public" => true,
                    "@value" => "CC0 1.0 Universal"
                ]
            ],
            "dcterms:alternative" => [
                [
                    "type" => "literal",
                    "property_id" => 17,
                    "property_label" => "Alternative Title",
                    "is_public" => true,
                    "@value" => $record->mCodexNumberNew
                ]
            ],
            "dcterms:created" => [
                [
                    "type" => "literal",
                    "property_id" => 20,
                    "property_label" => "Date Created",
                    "is_public" => true,
                    "@value" => $record->mDateDigitized
                ]
            ],
            "dcterms:isPartOf" => [
                [
                    "type" => "literal",
                    "property_id" => 33,
                    "property_label" => "Is Part Of",
                    "is_public" => true,
                    "@value" => $record->mCollection
                ]
            ],
            "dcterms:hasPart" => [
                [
                    "type" => "literal",
                    "property_id" => 34,
                    "property_label" => "Has Part",
                    "is_public" => true,
                    "@value" => $record->part
                ]
            ],
            "dcterms:hasFormat" => [
                [
                    "type" => "literal",
                    "property_id" => 38,
                    "property_label" => "Has Format",
                    "is_public" => true,
                    "@value" => "https://metascripta.org/iiif/VFL_" . $record->mFolderNumber . ".json"
                ]
            ],
            /*"dcterms:temporal" => [
                [
                    "type" => "literal",
                    "property_id" => 41,
                    "property_label" => "Temporal Coverage",
                    "is_public" => true,
                    "@value" => "15th"
                ]
            ],*/
            "dcterms:bibliographicCitation" => [
                [
                    "type" => "literal",
                    "property_id" => 48,
                    "property_label" => "Bibliographic Citation",
                    "is_public" => true,
                    "@value" => $record->mTextReference,
                ]
            ]
        ];
    }
}
