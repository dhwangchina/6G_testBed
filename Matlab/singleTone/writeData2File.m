function [ result ] = writeData2File(fName,dataArr)
%WRITEDATA2FILE 此处显示有关此函数的摘要
%   此处显示详细说明
reFile = fopen(fName,'w');
fprintf(reFile,'MEMORY_INITIALIZATION_RADIX  = 16;\n');
fprintf(reFile,'MEMORY_INITIALIZATION_VECTOR = \n');

for index = 1:length(dataArr)-1
    fprintf(reFile,'%04x,\n',dataArr(index));
end
fprintf(reFile,'%04x;\n',dataArr(length(dataArr)));

fclose(reFile);
result = 1;
end

