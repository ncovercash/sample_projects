total = 0
num = 0
denom = 1

for i in 0..1000
  tempNum = num
  num = denom
  denom = denom*2 + tempNum
  a = denom + num

  if(a.to_s.length > denom.to_s.length)
    total = total + 1
  end

end

puts total
