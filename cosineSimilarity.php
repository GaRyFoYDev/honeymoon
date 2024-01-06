<?php
class Recommendations
{

    public static function cosine_similarity($vector1, $vector2)
    {
        $dot_product = array_sum(array_map(function ($x, $y) {
            return $x * $y; }, $vector1, $vector2));

        $norm_vector1 = sqrt(array_sum(array_map(function ($x) {
            return $x * $x; }, $vector1)));
        $norm_vector2 = sqrt(array_sum(array_map(function ($x) {
            return $x * $x; }, $vector2)));

        $cosine = $dot_product / ($norm_vector1 * $norm_vector2);
        $cosine = round($cosine, 5);

        return $cosine;
    }

}

?>