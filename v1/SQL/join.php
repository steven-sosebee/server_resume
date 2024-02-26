<?php
    function SQLJoin($joinType="",$parentTable,$childTable,$childField,$parentField) {

        return "JOIN $childTable ON $parentTable.$parentField = $childTable.$childField";
        // return array(
        //     "JOIN"=>"JOIN $childTable ON $parentTable.$parentField = $childTable.$childField",
        // );

    }
?>