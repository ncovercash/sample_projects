total = 0
(0..999).step(3) do |i|
  total = total + i
end
(0..999).step(5) do |i|
  total = total + i
end
(0..999).step(15) do |i|
  total = total - i
end
puts total
