<?php


//custom functions

function pretty($format = "json", $min = 0, $indent = 0)
{
    if ($min == 1) {
        $indentChar = "";
    } else {
        if ($format == "html") $indentChar = "\t";
        if ($format == "txt") $indentChar = "\t";
        if ($format == "json") $indentChar = "\t";
    }
    return str_repeat($indentChar, $indent);
}

function mini($min = 0)
{
    if ($min == 0) $endChar = "\n";
    if ($min == 1) $endChar = "";
    return $endChar;
}

//expected parameters: id, format [html, json, txt], min [0, 1], source

if (isset($_GET['id']) && isset($_GET['format']) && isset($_GET['min']) && isset($_GET['source'])) {
    $valid = 1;
} else {
    $valid = 0;
    $response = 'Missing parameters. Required parameters are id, format, min, and source.';
    $errCode = 1;
    echo $response;
    exit(0);
}

if ($valid) {

    $id = $_GET['id'];
    $format = $_GET['format'];
    $min = $_GET['min'];
    $source = $_GET['source'];

    //check for ID
    if (strlen($id) < 1) {
        $response = 'No manuscript ID specified';
        $errCode = 2;
        echo $response;
        exit(0);
    }

    //check for empty FORMAT
    if (strlen($format) < 1) {
        $response = "No format specified";
        $errCode = 3;
        echo $response;
        exit(0);
    }

    if (strlen($source) < 1) {
        $response = "No source specified";
        $errCode = 4;
        echo $response;
        exit(0);
    }

    //check for valid FORMAT value
    //check for valid MIN value (only 0 or 1)

    if ($source == "p") $catalogTable = "00Published";
    if ($source == "q") $catalogTable = "00WebCatalog";
    $imageTable = "00JP2Catalog";

    include 'app-db.php';
    //retrieve manifest metadata from relevant SQL table based on object primary ID
    $sql1 = "SELECT * FROM $catalogTable a WHERE a.metascripta_id='$id' ORDER BY a.int_roll, a.int_manu;";

    if ($result = $mysqli->query($sql1)) {
        $row = $result->fetch_assoc();

        //variables: shelfmark, codex, country, century, language, reference, vfl_roll, vfl_part, metascripta_id, date_digitized
        foreach ($row as $key => $value) ${$key} = $value;

        //hard-coded, project-specific values not in database
        $license = 'CC0 1.0 Universal';
        $attributed = 'Saint Louis University Libraries';
        $license_url = 'https://creativecommons.org/publicdomain/zero/1.0/';
        $iiif_server_base_url = 'https://cantaloupe.metascripta.org/iiif/2/';
        $manifest_json_source_url = 'https://metascripta.org/iiif/';
        $description = "Vatican Film Library Manuscript on Microfilm";
        $label_start = "Saint Louis University, ";
        $logoImageURL = "https://metascripta.org/iiif/metascripta-logo.png";
        $omeka_document_url = "https://metascripta.org/document/";
        $aws_bucket_url = "https://metascripta-01.s3.amazonaws.com/";

        //combinations and variable name revisions
        $title = $shelfmark . ' ' . $codex;
        $lang = $language;
        $ref = str_replace('"', '\"', $reference);
        $roll = $vfl_roll;
        $shelf = $shelfmark;
        $manu = $codex;
        $part = $vfl_part;
        $id = $metascripta_id;
        $date = $date_digitized;
    } else {
        $response = "ID query was not successful.";
        $errCode = 4;
        echo $response;
        exit(0);
    }

    //FORMATTING COMPONENTS
    $startBrack = "{";
    $endBrack = "}";
    $nextBrack = "},";
    $nextObject = ",";

    //MANIFEST LEVEL STRINGS
    $startManifest = "{"; //for readability
    $endManifest = "}"; //for readability
    $iiif_manifest_context = '"@context": "http://iiif.io/api/presentation/2/context.json"';
    $iiif_image_context = '"@context": "http://iiif.io/api/image/2/context.json"';
    $iiif_image_server = 'https://cantaloupe.metascripta.org/iiif/2/';
    $iiif_image_level = 'http://iiif.io/api/image/2/level1.json';
    $idLevel1 = '"@id": "' . $manifest_json_source_url . 'VFL_' . $id . '.json"';
    $typeManifest = '"@type": "sc:Manifest"';
    $label = '"label": "' . $label_start . $title . '"';
    $description = '"description": "' . $description . '"';
    $structures = '"structures": []';

    $startSeeAlso = '"seeAlso": {';
    $seeAlso_URL = '"@id": "' . $omeka_document_url . $id . '"';
    $seeAlso_format = '"format": "text/html"';

    $startRendering = '"rendering": {';
    $rendering_URL = '"@id": "' . $aws_bucket_url . $id . '.pdf"';
    $rendering_label = '"label": "Download as PDF"';
    $rendering_format = '"format": "application/pdf"';

    $startThumbnail = '"thumbnail": {';
    $thumbnailId = '"@id": "' . $iiif_image_server . $id . '%2f' . $id . '_0002.jp2/full/120,/0/default.jpg"';
    $thumbnailServiceId = '"@id": "' . $iiif_image_server . $id . '%2f' . $id . '_0002.jp2/"';
    $thumbnailProfile = '"profile": "' . $iiif_image_level . '"';
    $attribution = '"attribution": "' . $attributed . '"';
    $logo = '"logo": "' . $logoImageURL . '"';

    //removed 11-23-2020
    //$startAttribution = '"attribution": {';
    //$attributionValue = '"@value": "'.$attributed.'"';

    //METADATA STRINGS
    $startMetadata = '"metadata": [';
    $metadata1 = '"label": "Shelfmark"';
    $metadata1val = '"value": "' . $title . '"';
    $metadata11 = '"label": "VFL Part"';
    $metadata11val = '"value": "' . $part . '"';
    $metadata2 = '"label": "Century"';
    $metadata2val = '"value": "' . $century . '"';
    $metadata3 = '"label": "Country"';
    $metadata3val = '"value": "' . $country . '"';
    $metadata4 = '"label": "Language"';
    $metadata4val = '"value": "' . $lang . '"';
    $metadata5 = '"label": "Reference"';
    $metadata5val = '"value": "' . $ref . '"';
    $metadata6 = '"label": "METAscripta ID"';
    $metadata6val = '"value": "' . $id . '"';
    $metadata7 = '"label": "VFL Roll"';
    $metadata7val = '"value": "' . $roll . '"';
    $metadata8 = '"label": "Date Digitized"';
    $metadata8val = '"value": "' . $date . '"';

    $license = '"license": "https://creativecommons.org/publicdomain/zero/1.0/"';
    $endMetadata = ']';

    //SEQUENCE STRINGS
    $startSequence = '"sequences": [';
    $sequenceCnt++;
    $sequenceId = '"@id": "https://SEQUENCE_ID_' . $sequenceCnt . '"';
    $sequenceType = '"@type": "sc:Sequence"';
    $sequenceLabel = '"label": "Normal Sequence"';
    $endSequence = ']';

    //CANVAS STRINGS
    $startCanvas = '"canvases": [';
    $canvasCnt++;
    $canvasId = '"@id": "https://metascripta.org/iiif/' . $id;
    $canvasType = '"@type": "sc:Canvas"';
    $canvasLabel = '"label": "'; //VTL_00753_01_0001",
    $canvasHeight = '"height": '; //3781,
    $canvasWidth = '"width": '; //5116,
    $nextCanvas = "},";
    $endCanvas = ']';

    //IMAGES STRINGS
    $startImage = '"images": [';
    $imageCnt++;
    $imageId = '"@id": "https://IMAGE_ID';
    $imageType = '"@type": "oa:Annotation"';
    $imageMotivation = '"motivation": "sc:painting"';
    $endImage = ']';

    //RESOURCE STRINGS
    $startResource = '"resource": ';
    $resourceId = '"@id": "' . $iiif_image_server . $id . '%2f';
    //"@id": "http:\\cantaloupe.metascripta.org/iiif/2/VTL_00753_01%2fVTL_00753_01_0001.tif/full/full/0/default.jpg",
    $resourceType = '"@type": "dctypes:Image"';
    $resourceFormat = '"format": "image/jpeg"';
    $resourceHeight = '"height": '; //3781,
    $resourceWidth = '"width": '; //5116,
    $resourceOn = '"on": "https://metascripta.org/iiif/' . $id; //oa:Annotation['on']
    $endResource = '}';

    //SERVICE STRINGS
    $startService = '"service": {';
    $serviceId = '"@id": "' . $iiif_image_server . $id . '%2f';
    //@id": "http:\\cantaloupe.metascripta.org/iiif/2/VTL_00753_01%2fVTL_00753_01_0001.tif",
    $endService = "}";

    //PROFILE STRINGS - Version 1.1
    $startProfileMulti = '"profile": ';
    $profileLevel = '"' . $iiif_image_level . '"';
    $endProfileMulti = '';

    //FORMATS STRINGS - Remove in Version 1.1
    //$startFormats = '"formats": [';
    //$formatJPG = '"jpg"';
    //$endFormats = ']';

    //THUMBNAIL STRING
    //$manifest = "";
    $manifest = "{" . mini($min);
    $manifest .= pretty($format, $min, 1) . "$iiif_manifest_context," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$idLevel1," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$typeManifest," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$label," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$license," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$description," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$attribution," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$logo," . mini($min);

    //PLACEHOLDER
    //$manifest.= pretty($format,$min,1)."$structures,".mini($min);

    $manifest .= pretty($format, $min, 1) . "$startSeeAlso" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$seeAlso_URL," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$seeAlso_format" . mini($min);
    $manifest .= pretty($format, $min, 1) . "$endBrack," . mini($min);

    $manifest .= pretty($format, $min, 1) . "$startRendering" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$rendering_URL," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$rendering_label," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$rendering_format" . mini($min);
    $manifest .= pretty($format, $min, 1) . "$endBrack," . mini($min);

    $manifest .= pretty($format, $min, 1) . "$startThumbnail" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$thumbnailId," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startService" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$iiif_image_context," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$thumbnailServiceId," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$thumbnailProfile" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack" . mini($min);
    $manifest .= pretty($format, $min, 1) . "$endBrack," . mini($min);

    $manifest .= pretty($format, $min, 1) . "$startMetadata" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata1," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata1val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata11," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata11val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata2," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata2val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata3," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata3val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata4," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata4val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata5," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata5val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata6," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata6val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata7," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata7val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack," . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata8," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$metadata8val" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack" . mini($min);
    $manifest .= pretty($format, $min, 1) . "$endMetadata," . mini($min);
    $manifest .= pretty($format, $min, 1) . "$startSequence" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$startBrack" . mini($min);
    $manifest .= pretty($format, $min, 3) . "$sequenceId," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$sequenceType," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$sequenceLabel," . mini($min);
    $manifest .= pretty($format, $min, 3) . "$startCanvas" . mini($min);

    //retrieve exact pixel dimensions for each image in order to provide correct canvas size
    $sql2 = "SELECT * FROM $imageTable a LEFT JOIN
  (SELECT metascripta_id, MAX(CAST(frame as INT)) AS `maxframe` FROM 00JP2Catalog GROUP BY metascripta_id) b
  ON a.metascripta_id=b.metascripta_id WHERE a.metascripta_id='$id' ORDER BY a.frame ASC;";

    if ($result = $mysqli->query($sql2)) {
        //canvas+sequence+image loop = 1 canvas per image
        while ($row = $result->fetch_assoc()) {

            $iiif_image = trim($row['frame']);
            $iiif_image_format = trim($row['format']);
            $iiif_image_width = trim($row['width']);
            $iiif_image_height = trim($row['height']);
            $canvasMaxFrame = trim($row['maxframe']);

            $canvasIdLoop = $canvasId . '/' . $canvasCnt . '"';
            $canvasLabelLoop = $canvasLabel . $id . '_' . $iiif_image . '"';
            $canvasWidthLoop = $canvasWidth . $iiif_image_width;
            $canvasHeightLoop = $canvasHeight . $iiif_image_height;
            $resourceIdLoop = $resourceId . $id . '_' . $iiif_image . '.' . $iiif_image_format . '/full/full/0/default.jpg"';
            $serviceIdLoop = $serviceId . $id . '_' . $iiif_image . '.' . $iiif_image_format . '"';
            $resourceWidthLoop = $resourceWidth . $iiif_image_width;
            $resourceHeightLoop = $resourceHeight . $iiif_image_height;
            $resourceOnLoop = $resourceOn . '/' . $canvasCnt . '"';
            $imageIdLoop = $imageId . '_' . $imageCnt . '"';

            $manifest .= pretty($format, $min, 4) . "$startBrack" . mini($min);
            $manifest .= pretty($format, $min, 5) . "$canvasIdLoop," . mini($min);
            $manifest .= pretty($format, $min, 5) . "$canvasType," . mini($min);
            $manifest .= pretty($format, $min, 5) . "$canvasLabelLoop," . mini($min);
            $manifest .= pretty($format, $min, 5) . "$canvasHeightLoop," . mini($min);
            $manifest .= pretty($format, $min, 5) . "$canvasWidthLoop," . mini($min);
            $manifest .= pretty($format, $min, 5) . "$startImage" . mini($min);
            $manifest .= pretty($format, $min, 5) . "$startBrack" . mini($min);
            $manifest .= pretty($format, $min, 6) . "$imageIdLoop," . mini($min);
            $manifest .= pretty($format, $min, 6) . "$imageType," . mini($min);
            $manifest .= pretty($format, $min, 6) . "$imageMotivation," . mini($min);
            $manifest .= pretty($format, $min, 6) . "$startResource" . mini($min);
            $manifest .= pretty($format, $min, 6) . "$startBrack" . mini($min);
            $manifest .= pretty($format, $min, 7) . "$resourceIdLoop," . mini($min);
            $manifest .= pretty($format, $min, 7) . "$resourceType," . mini($min);
            $manifest .= pretty($format, $min, 7) . "$resourceFormat," . mini($min);
            $manifest .= pretty($format, $min, 7) . "$resourceHeightLoop," . mini($min);
            $manifest .= pretty($format, $min, 7) . "$resourceWidthLoop," . mini($min);
            $manifest .= pretty($format, $min, 7) . "$startService" . mini($min);
            $manifest .= pretty($format, $min, 8) . "$iiif_image_context," . mini($min);
            $manifest .= pretty($format, $min, 8) . "$serviceIdLoop," . mini($min);
            $manifest .= pretty($format, $min, 8) . "$startProfileMulti $profileLevel $endProfileMulti" . mini($min);
            $manifest .= pretty($format, $min, 7) . "$endService" . mini($min);
            $manifest .= pretty($format, $min, 6) . "$endResource," . mini($min);
            $manifest .= pretty($format, $min, 5) . "$resourceOnLoop" . mini($min);
            $manifest .= pretty($format, $min, 5) . "$endBrack" . mini($min);
            $manifest .= pretty($format, $min, 5) . "$endImage" . mini($min);

            if ($canvasCnt == $canvasMaxFrame)
                $manifest .= pretty($format, $min, 4) . "$endBrack" . mini($min);
            else
                $manifest .= pretty($format, $min, 4) . "$endBrack," . mini($min);

            //increase counters
            $imageCnt++;
            $canvasCnt++;

        } //end while
    } //end if

    $manifest .= pretty($format, $min, 3) . "$endCanvas" . mini($min);
    $manifest .= pretty($format, $min, 2) . "$endBrack" . mini($min);
    $manifest .= pretty($format, $min, 1) . "$endSequence" . mini($min);
    $manifest .= pretty($format, $min, 0) . "$endManifest" . mini($min);

    if ($format == "json") {
        header('Content-Type: application/json');
        echo trim($manifest);
    } elseif ($format == "html") {
        echo "<pre>";
        echo trim($manifest);
    } elseif ($format == "txt") {
        header('Content-Type: application/txt');
        header('Content-Transfer-Encoding: binary');
        header('Content-Type: application/force-download');
        header('Content-disposition: attachment;filename="$id.txt"');
        echo trim($manifest);
    }
    if ($format == "html")
        echo "</pre>";
}
