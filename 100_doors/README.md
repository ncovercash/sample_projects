# 100 Doors

There are 100 doors in a row that are all initially closed.

You make 100 passes by the doors.

The first time through, visit every door and toggle the door (if the door is closed, open it; if it is open, close it).

The second time, only visit every 2nd door (door #2, #4, #6, ...), and toggle it.

The third time, visit every 3rd door (door #3, #6, #9, ...), etc, until you only visit the 100th door.

**Answer the question: what state are the doors in after the last pass? Which are open, which are closed?**

<details> 
<summary>Expected Result</summary>
<p>Closed doors:
```
[ 2 3 5 6 7 8 10 11 12 13 14 15 17 18 19 20 21 22 23 24 26 27 28 29 30 31 32 33 34 35 37 38 39 40 41 42 43 44 45 46 47 48 50 51 52 53 54 55 56 57 58 59 60 61 62 63 65 66 67 68 69 70 71 72 73 74 75 76 77 78 79 80 82 83 84 85 86 87 88 89 90 91 92 93 94 95 96 97 98 99 ]
```
Open doors:  
```
[ 1 4 9 16 25 36 49 64 81 100 ]
```
</p> 
</details>

<a href="http://rosettacode.org/wiki/100_doors">Original Problem</a>
