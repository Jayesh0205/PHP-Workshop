<?php

$students = [
    "Amit"    => 78,
    "Sneha"   => 92,
    "Raj"     => 65,
    "Priya"   => 88,
    "Vikram"  => 74
];

// Total and Average
$total = 0;
foreach ($students as $name => $marks) {
    $total += $marks;
}
$average = $total / count($students);

// Highest and Lowest
$highest_name = "";
$lowest_name  = "";
$highest_marks = -1;
$lowest_marks  = 101;

foreach ($students as $name => $marks) {
    if ($marks > $highest_marks) {
        $highest_marks = $marks;
        $highest_name  = $name;
    }
    if ($marks < $lowest_marks) {
        $lowest_marks = $marks;
        $lowest_name  = $name;
    }
}

// Sort by marks descending (without losing name-mark relation)
// Manual bubble sort
$names  = array_keys($students);
$marks_arr = array_values($students);

$n = count($names);
for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($marks_arr[$j] < $marks_arr[$j + 1]) {
            // Swap marks
            $temp = $marks_arr[$j];
            $marks_arr[$j] = $marks_arr[$j + 1];
            $marks_arr[$j + 1] = $temp;
            // Swap names too
            $temp = $names[$j];
            $names[$j] = $names[$j + 1];
            $names[$j + 1] = $temp;
        }
    }
}

// Display
echo "===== Student Marks (Descending) =====\n";
for ($i = 0; $i < $n; $i++) {
    echo $names[$i] . " => " . $marks_arr[$i] . "\n";
}

echo "\nTotal Marks  : " . $total;
echo "\nAverage Marks: " . $average;
echo "\nHighest Scorer: " . $highest_name . " (" . $highest_marks . ")";
echo "\nLowest Scorer : " . $lowest_name  . " (" . $lowest_marks  . ")";

?>
<?php

$products = [];

// Add product
function addProduct(&$products, $id, $name, $price, $quantity) {
    foreach ($products as $product) {
        if ($product["id"] == $id) {
            echo "Error: Product ID $id already exists.\n";
            return;
        }
    }
    $products[] = [
        "id"       => $id,
        "name"     => $name,
        "price"    => $price,
        "quantity" => $quantity
    ];
    echo "Product '$name' added successfully.\n";
}

// Update price by id
function updatePrice(&$products, $id, $new_price) {
    for ($i = 0; $i < count($products); $i++) {
        if ($products[$i]["id"] == $id) {
            $products[$i]["price"] = $new_price;
            echo "Price updated for ID $id.\n";
            return;
        }
    }
    echo "Product ID $id not found.\n";
}

// Delete by id
function deleteProduct(&$products, $id) {
    for ($i = 0; $i < count($products); $i++) {
        if ($products[$i]["id"] == $id) {
            array_splice($products, $i, 1);
            echo "Product ID $id deleted.\n";
            return;
        }
    }
    echo "Product ID $id not found.\n";
}

// Display all
function displayProducts($products) {
    echo "\n===== Product List =====\n";
    if (count($products) == 0) {
        echo "No products found.\n";
        return;
    }
    foreach ($products as $p) {
        echo "ID: " . $p["id"] . " | Name: " . $p["name"] . " | Price: Rs." . $p["price"] . " | Qty: " . $p["quantity"] . "\n";
    }
}

// --- Testing ---
addProduct($products, 1, "Laptop",  55000, 10);
addProduct($products, 2, "Mouse",   799,   50);
addProduct($products, 3, "Keyboard",1299,  30);
addProduct($products, 1, "Monitor", 12000, 5);  // Duplicate test

displayProducts($products);

updatePrice($products, 2, 999);
deleteProduct($products, 3);

displayProducts($products);

?>
<?php

function countWords($sentence) {
    // Lowercase and remove punctuation
    $sentence = strtolower($sentence);
    $sentence = preg_replace("/[^a-z\s]/", "", $sentence);

    $words = explode(" ", trim($sentence));

    $frequency = [];

    foreach ($words as $word) {
        if ($word == "") continue;

        if (isset($frequency[$word])) {
            $frequency[$word]++;
        } else {
            $frequency[$word] = 1;
        }
    }

    // Sort by frequency descending (manual bubble sort)
    $keys   = array_keys($frequency);
    $values = array_values($frequency);
    $n = count($keys);

    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($values[$j] < $values[$j + 1]) {
                $temp = $values[$j];
                $values[$j] = $values[$j + 1];
                $values[$j + 1] = $temp;

                $temp = $keys[$j];
                $keys[$j] = $keys[$j + 1];
                $keys[$j + 1] = $temp;
            }
        }
    }

    echo "===== Word Frequency =====\n";
    for ($i = 0; $i < $n; $i++) {
        echo $keys[$i] . " => " . $values[$i] . "\n";
    }
}

$sentence = "The cat sat on the mat. The cat is on the mat!";
countWords($sentence);

?>
<?php

function customFilter($numbers, $condition, $value = 0) {
    $result = [];

    for ($i = 0; $i < count($numbers); $i++) {
        if ($condition == "even") {
            if ($numbers[$i] % 2 == 0) {
                $result[] = $numbers[$i];
            }
        } else if ($condition == "greater") {
            if ($numbers[$i] > $value) {
                $result[] = $numbers[$i];
            }
        }
    }

    return $result;
}

$numbers = [3, 8, 15, 22, 7, 14, 6, 19, 2, 11];

$even_numbers    = customFilter($numbers, "even");
$greater_numbers = customFilter($numbers, "greater", 10);

echo "Original Array  : ";
echo implode(", ", $numbers);

echo "\nEven Numbers    : ";
echo implode(", ", $even_numbers);

echo "\nGreater than 10 : ";
echo implode(", ", $greater_numbers);

?>