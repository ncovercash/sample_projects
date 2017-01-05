#include<iostream>
#include<array>
#include<numeric>
#include<algorithm>
#include<functional>
#include<iterator>

int main() {
    constexpr int numbers_count = 2;
    std::array<int,numbers_count> numbers;
    std::copy_n(std::istream_iterator<int>(std::cin), numbers_count, std::begin(numbers));
    std::cout<< std::accumulate(numbers.begin(),numbers.end(),0,std::plus<int>())<<std::endl;
}

// credit for this code goes to hicklc01
