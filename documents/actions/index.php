<?php
function index_ALL(Web $w) {
	foreach ($w->Documents->getRegisteredTypeNames() as $tn) {
		print_r($w->Documents->getType($tn));
	}
}