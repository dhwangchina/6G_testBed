/*
 * test_cpp17.cpp
 *
 *  Created on: 2022年1月27日
 *      Author: Administrator
 */

#include "test_cpp17.hpp"
#include <string.h>
#include <iostream>
#include <string>
#include <limits>
#include <stdexcept>
#include <functional>

template <auto v>

auto foo()
{
    cout<<"Input parameter is:"<<v<<endl;
    return v;
}

MyStruct getStruct()
{
    return MyStruct{42,"Hello World"};
}


class MathUtils
{
public:
    static double average(int a, int b)
    {
        return a + b / 2;
    }
};

//#ifndef RunTests
//int main()
//{
//    std::cout << MathUtils::average(2, 1);
//}
//#endif

void tileEdges(std::vector<std::vector<bool>>& tiles)
{
    int i,j;
    unsigned int ulRow = tiles.size();
    unsigned int ulCol = tiles[0].size();

    for(i = 0; i < ulRow; i++)
    {
        for(j = 0; j < ulCol; j++)
        {
            if(i == 0 || i == ulRow - 1)
            {
                tiles[i][j] = 1;
            }
            else if(j == 0 || j == ulCol - 1)
            {
                tiles[i][j] = 1;
            }
            else
            {
                tiles[i][j] = 0;
            }
        }
    }
}

std::string changeFormat(const std::string paragraph)
{
    std::string ch0;
    std::string ch1;
    std::string ch2;
    std::string ch3;

    int len = paragraph.size();
    int C_CNT_LEN = 12;
    int ulStart = len - C_CNT_LEN;

    std::cout<<paragraph<<std::endl;

    ch1 = paragraph.substr(ulStart,3);
    ulStart = ulStart + 4;
    ch2 = paragraph.substr(ulStart,2);
    ulStart = ulStart + 3;
    ch3 = paragraph.substr(ulStart,4);

    ch0 = ch1 + "/" + ch3 + "/" + ch2;

    return ch0;
}

bool isLimit(double value)
{
    return !(value > std::numeric_limits<double>::min() || value < std::numeric_limits<double>::max());
}




class ReptileEgg;

class Reptile
{
public:
    virtual ~Reptile() {};
    virtual ReptileEgg* lay() = 0;
};

class ReptileEgg
{
public:
    ReptileEgg(std::function<Reptile* ()> createReptile)
    {
        //throw std::logic_error("Waiting to be implemented");
    }

    Reptile* hatch()
    {
//        throw std::logic_error("Waiting to be implemented");
    	Reptile* pRep = NULL;
    	return pRep;
    }
};

class FireDragon : public Reptile
{
public:
    FireDragon()
    {
    }

    ReptileEgg* lay()
    {
        //throw std::logic_error("Waiting to be implemented");
    	ReptileEgg *pEgg = NULL;

    	return pEgg;
    }
};

void test_cpp17(void)
{
#if 0
    MyStruct ms;
    auto [u,v] = ms;
    auto [u2,v2] {ms};
    auto [u3,v3] (ms);
    auto e = ms;

    int iVal{32};
    std::string s{"Hello World"};

    printf("initialize iVal:%d\n",iVal);
    std::cout<<"S string is:"<<s<<std::endl;

    auto [id, val] = getStruct();
    std::cout<<"id is:"<<id<<std::endl;
    std::cout<<"val is:"<<val<<std::endl;

//    auto& e1 = getStruct();

    std::cout<<"foo return: "<<foo<2022>()<<std::endl;

    for (int i = 0; i < 10; ++i)
    {
        if (int m = i % 2; 0 == m)
        {
            std::cout<<"i: "<<i<<std::endl;
        }
    }
#endif
#if 0
    std::cout << MathUtils::average(2, 1);
#endif
#if 0
    std::vector<std::vector<bool>> tiles(4, std::vector<bool>(4));
    tileEdges(tiles);
    for (unsigned x = 0; x < tiles.size(); x++)
    {
        for (unsigned y = 0; y < tiles[x].size(); y++)
        {
            std::cout << tiles[x][y] << " ";
        }
        std::cout << std::endl;
    }
#endif
#if 0
    std::cout << changeFormat("Please quote your policy number: 112-39-8552.");
#endif
#if 0
    std::cout << isLimit(1);
#endif
    Reptile* fireDragon = new FireDragon();

    ReptileEgg* egg      = fireDragon->lay();
    Reptile* childDragon = egg->hatch();
}

